<?php

namespace App\Controllers; 

use App\services\AuthService; 
 

class LoginController
{
    private $twig;
    private $authService;

    public function __construct()
    {

          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
        $this->authService = new AuthService();

    }


    public function index()
    {
       echo  $this->twig->render('auth/login.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    
    public function login(){
        $this->authService->add(   [
            "nom" => "Dupont",
            "prenom" => "Jean",
            "email" => "jean.dupont@example.com",
            "mot_de_passe" => password_hash("admin", PASSWORD_DEFAULT), // Hashé pour la sécurité
            "date_creation" => date("Y-m-d H:i:s"), // Date actuelle
            "is_active" => true
        ]);
        // $email = $_POST['email'] ;
        // $password = $_POST['password'] ;
        // $message =  $this->authService->login($email, $password);
        // echo $message;
    }



    
}