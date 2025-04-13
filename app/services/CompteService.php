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

    public function __construct() {
        $this->compteRepo = new CompteRepository();
        $this->clientRepo = new ClientRepository();

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


        $to = $user->getEmail();  
        $nom = $user->getNom();
        $prenom = $user->getprenom();
    
        $subject = "Votre compte a ete approuve ";
        $message = "Bonjour $nom $prenom,\n\nVotre compte a été approuvé avec succès.\nVoici vos identifiants de connexion :\n\nEmail: $to\nMot de passe: $plainPassword\nNuméro de compte: $numeroCompte\n\nNous vous recommandons de changer ce mot de passe dès votre première connexion.\n\nCordialement,\nL'équipe ESSEMLALI-Bank";
    
        return $this->sendEmail($to, $subject, $message);
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
    
            $subject = "Votre demande de création de compte a ete refusée";
            $message = "Bonjour $nom $prenom,\n\n
                        Après examen de votre demande, nous sommes au regret de vous informer que votre demande de création de compte a été refusée.\n\n
                        Si vous souhaitez obtenir plus d'informations sur les raisons de ce refus, n'hésitez pas à nous contacter à l'adresse support@essemlali-bank.com.\n\n
                        Cordialement,\n
                        L'équipe ESSEMLALI-Bank.";
    
            return $this->sendEmail($to, $subject, $message);
        }
    
        return " Erreur lors de l'approbation du compte.";
    }

    public function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
    
        try {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__,2));
                $dotenv->load();

            $mail->CharSet = 'UTF-8';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['USERNAME'];; 
            $mail->Password = $_ENV['PASSWORD'];; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
         
            $mail->setFrom('support@essemlalibank.com', 'Service Client - Essemlali Bank');
            $mail->addAddress($to); 
            $mail->addReplyTo('support@essemlalibank.com', 'Service Client - Essemlali Bank');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = nl2br($message);
            $mail->AltBody = strip_tags($message); 
            $mail->send();
            return true;
        } catch (Exception $e) {
            return " Erreur lors de l'envoi de l'email à $to. Erreur : {$mail->ErrorInfo}";
        }
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
    
}
