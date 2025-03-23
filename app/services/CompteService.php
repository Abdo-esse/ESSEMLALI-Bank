<?php

namespace App\services;

use App\Repository\CompteRepository;

class CompteService {
    private CompteRepository $compteRepo;

    public function __construct() {
        $this->compteRepo = new CompteRepository();

    }

    public function create(){
        
     
       return $this->compteRepo->create($dataUser,$dataCompte);
        
    }
    public function approuver($id)
    {
        $plainPassword = bin2hex(random_bytes(4)); 
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    
        $data = [
            "is_active" => "true",
            "password" => $hashedPassword
        ];
         $updated = $this->compteRepo->update('users', $id, $data);
    
        if ($updated) {
            $user = $this->compteRepo->findById('users', $id);
            if (!$user) {
                return false;
            }
    
            $to = $user['email'];  
            $nom = $user['nom'];
    
            $subject = "Votre compte a été approuvé ✅";
            $message = "Bonjour $nom,\n\nVotre compte a été approuvé avec succès.\nVoici vos identifiants de connexion :\n\nEmail: $to\nMot de passe: $plainPassword\n\nNous vous recommandons de changer ce mot de passe dès votre première connexion.\n\nCordialement,\nL'équipe ESSEMLALI-Bank";
    
            return $this->sendEmail($to, $subject, $message);
        }
    
        return "🚨 Erreur lors de l'approbation du compte.";
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
        $headers = "From: support@essemlali-bank.com\r\n";
        $headers .= "Reply-To: support@essemlali-bank.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
        if (mail($to, $subject, $message, $headers)) {
            return "✅ Email envoyé avec succès à $to";
        } else {
            return "🚨 Erreur lors de l'envoi de l'email à $to.";
        }
    }
    
}
