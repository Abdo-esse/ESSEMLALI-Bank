<?php

namespace App\services;

use App\Repository\CompteRepository;
use App\Repository\ClientRepository;
use Ramsey\Uuid\Uuid;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;


require dirname(__DIR__) . '/../vendor/autoload.php'; 


class CompteService {
    private CompteRepository $compteRepo;
    private ClientRepository $clientRepo;
    private EmailService $emailService;

    public function __construct() {
        $this->compteRepo = new CompteRepository();
        $this->clientRepo = new ClientRepository();
        $this->emailService= new EmailService();

    }

    public function create($clientId){
        $numeroCompte = $this->generateAccountNumber(); 
        $solde = isset($_POST['solde']) ? floatval($_POST['solde']) : 0.0;
    
        $data = [
            "numeroCompte" => $numeroCompte,
            "solde" => $solde,
            "client_id "=>$clientId
        ];
    
        $create=$this->compteRepo->create($data);
        return $numeroCompte;
    }
    
    public function approuver($id)
    {
        $plainPassword = bin2hex(random_bytes(4)); 
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    
        $data = [
            "is_active" => "true",
            "mot_de_passe" => $hashedPassword
        ];
    
        $updated = $this->compteRepo->update('users', $id, $data);
        $user =$this->clientRepo->find('roles', $id);
        $clientId = $user->getClientId();  

        $numeroCompte = $this->create($clientId);
        
        if (!$updated) {
            return "Erreur lors de l'approbation du compte.";
        }

        $fullName = $user->getNom() . ' ' . $user->getprenom();
        
        return $this->emailService->sendAccountApproval(
            $user->getEmail(),
            $fullName,
            $plainPassword,
            $numeroCompte
        );
    }
       

    public function refuser($id){
        $data=[
            "is_active"=>"false" ,
            "date_suppression"=>date('Y-m-d H:i:s') 
        ];
        $updated = $this->compteRepo->update('users', $id, $data);

        $user =$this->clientRepo->find('roles', $id);

        $to = $user->getEmail();  
        $nom = $user->getNom();
        $prenom = $user->getprenom();
    
        if ($updated) {
            $fullName = $user->getNom() . ' ' . $user->getPrenom(); 
            return $this->emailService->sendAccountRejection( $to,$fullName);
        }
    
        return " Erreur lors de l'approbation du compte.";
    }
    public function generateAccountNumber() {
        $uuid = Uuid::uuid4()->toString(); 
        $shortUuid = substr(str_replace('-', '', $uuid), 0, 12); 
    
        return 'BANK-' . strtoupper($shortUuid); 
    }

    public function find($numeroCompte){
        return $this->compteRepo->findAcount($numeroCompte);
    }
    public function deposit(){
        $acount= $this->compteRepo->findAcount($_POST["account_number"]);
        $nouveauSolde = $acount->getSolde() + $_POST["amount"];
         return $this->compteRepo->update('comptes',$acount->getId(),["solde"=>$nouveauSolde]);
        
    }
    public function retrait(){
        $acount= $this->compteRepo->findAcount($_POST["account_number"]);
        $nouveauSolde = $acount->getSolde() - $_POST["amount"];
         return $this->compteRepo->update('comptes',$acount->getId(),["solde"=>$nouveauSolde]);
        
    }
    
}
