<?php

namespace App\services;

use App\Repository\CompteRepository;
use App\Repository\ClientRepository;
use Ramsey\Uuid\Uuid;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/../vendor/autoload.php'; 


class CompteService {
    private CompteRepository $compteRepo;
    private ClientRepository $clientRepo;

    public function __construct() {
        $this->compteRepo = new CompteRepository();
        $this->clientRepo = new ClientRepository();

    }

    public function create(){
        $numeroCompte = $this->generateAccountNumber(); 
        $solde = isset($_POST['solde']) ? floatval($_POST['solde']) : 0.0;
    
        $data = [
            "numeroCompte" => $numeroCompte,
            "solde" => $solde,
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
        $numeroCompte = $this->create();
        
        if (!$updated) {
            return "Erreur lors de l'approbation du compte.";
        }

        $user =$this->clientRepo->find('roles', $id);

        $to = $user->getEmail();  
        $nom = $user->getNom();
        $prenom = $user->getprenom();
    
        $subject = "Votre compte a été approuvé ✅";
        $message = "Bonjour $nom $prenom,\n\nVotre compte a été approuvé avec succès.\nVoici vos identifiants de connexion :\n\nEmail: $to\nMot de passe: $plainPassword\nNuméro de compte: $numeroCompte\n\nNous vous recommandons de changer ce mot de passe dès votre première connexion.\n\nCordialement,\nL'équipe ESSEMLALI-Bank";
    
        return $this->sendEmail($to, $subject, $message);
    }
    
    


    public function getAll(){
        return $this->compteRepo->readAll('roles');
    }
    public function find($id){
        return $this->compteRepo->find('roles', $id);
    }

    

    public function refuser($id){
        $data=[
            "is_active"=>"false" ,
            "date_suppression"=>date('Y-m-d H:i:s') 
        ];
        $updated = $this->compteRepo->update('users', $id, $data);
    
        if ($updated) {
            $user = $this->compteRepo->findById('users', $id);
            if (!$user) {
                return false;
            }
    
            $to = $user['email'];  
            $nom = $user['nom'];
    
            $subject = "Votre demande de création de compte a été refusée ❌";
            $message = "Bonjour $nom,\n\n
                        Après examen de votre demande, nous sommes au regret de vous informer que votre demande de création de compte a été refusée.\n\n
                        Si vous souhaitez obtenir plus d'informations sur les raisons de ce refus, n'hésitez pas à nous contacter à l'adresse support@essemlali-bank.com.\n\n
                        Cordialement,\n
                        L'équipe ESSEMLALI-Bank.";
    
            return $this->sendEmail($to, $subject, $message);
        }
    
        return "🚨 Erreur lors de l'approbation du compte.";
    }

    public function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
    
        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'abdelilahessemlali@gmail.com'; // Votre adresse e-mail
            $mail->Password = 'hfjq xfmx oojp udat'; // Mot de passe ou mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurisation par TLS
            $mail->Port = 587; // Port SMTP (587 pour TLS, 465 pour SSL)
    
            // Expéditeur et destinataire
            $mail->setFrom('abdelilahessemlali@gmail.com', 'Abdel Ilah ESSEMLALI');
            $mail->addAddress($to); // Destinataire
    
            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = nl2br($message); // Convertit les sauts de ligne en HTML
            $mail->AltBody = strip_tags($message); // Version texte brut
    
            // Envoi de l'e-mail
            $mail->send();
            return "✅ Email envoyé avec succès à $to";
        } catch (Exception $e) {
            return "🚨 Erreur lors de l'envoi de l'email à $to. Erreur : {$mail->ErrorInfo}";
        }
    }
    public function generateAccountNumber() {
        $uuid = Uuid::uuid4()->toString(); 
        $shortUuid = substr(str_replace('-', '', $uuid), 0, 12); 
    
        return 'BANK-' . strtoupper($shortUuid); 
    }
    
}
