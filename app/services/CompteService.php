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
    $data = [
        "is_active" => "true"
    ];
    $updated = $this->compteRepo->update('users', $id, $data);

    if ($updated) {
        
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
        return $this->compteRepo->update('users', $id, $data);
    }

    public function sendEmail($id){
        $user = $this->compteRepo->findById('users', $id);
        $to = $user['email']; 
        $subject = "Votre compte a été approuvé ✅";
        $message = "Bonjour " . $user['nom'] . ",\n\nVotre compte a été approuvé avec succès. Vous pouvez maintenant vous connecter.\n\nCordialement,\nL'équipe ESSEMLALI-Bank";
        $headers = "From: support@essemlali-bank.com\r\n";
        $headers .= "Reply-To: support@essemlali-bank.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoyer l'email
        if (mail($to, $subject, $message, $headers)) {
            return "✅ Email envoyé avec succès à $to";
        } else {
            return "🚨 Échec de l'envoi de l'email.";
        }

    }
    
}
