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
        // $email = $_POST['email'] ?? '';
        // $password = $_POST['password'] ?? '';
        // $message = $authService->login($email, $password);
        // echo $message;
        $plainPassword = "admin";

// Générer un mot de passe haché
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

echo "Mot de passe haché : " . $hashedPassword;
exit();
    }



    
}