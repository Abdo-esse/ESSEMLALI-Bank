<?php

namespace App\Controllers; 

use App\services\AuthService; 
use App\requests\LoginRequest;
use App\core\Session;

class LoginController
{
    private $twig;
    private $authService;

    public function __construct()
    {
        $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
        $this->authService = new AuthService();
        Session::start();
    }


    public function index()
    {
       echo  $this->twig->render('auth/login.twig',[
        'session' => $_SESSION
    ]);

    }
    
    public function login(){
        $request = new LoginRequest($_POST);
            
        if (!$request->validate()) {
            Session::set('error', $request->getErrors());
            Session::set('valueslogin', $_POST);
            header('Location: /ESSEMLALI-Bank/login');
            exit;
        }
        Session::unset('error');
        Session::unset('valueslogin');
        $email = $_POST['email'] ;
        $password = $_POST['password'] ;
        if (!$this->authService->login($email, $password)) {
            header('Location: /ESSEMLALI-Bank/login');
            exit;
        }
        $role = Session::get('user')['role'];
         $this->redirectUserByRole($role);
    }


    private function redirectUserByRole($role){
        return match ($role) {
            'Admin' => header('Location: /ESSEMLALI-Bank/Admin'),
            'Employé' => header('Location: /ESSEMLALI-Bank/Employe'),
            'Client' => header('Location: /ESSEMLALI-Bank/Client'),
            default => "unknown" 
        };
    }
    

    
}