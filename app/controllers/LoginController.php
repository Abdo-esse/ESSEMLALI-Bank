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
       echo  $this->twig->render('auth/login.html.twig',[
        'session' => $_SESSION
    ]);

    }
    
    public function login(){
        $request = new LoginRequest($_POST);
            
        if (!$request->validate()) {
            Session::set('error', $request->getErrors());
            header('Location: /ESSEMLALI-Bank/login');
            exit;
        }
        $email = $_POST['email'] ;
        $password = $_POST['password'] ;
        if (!$this->authService->login($email, $password)) {
            Session::set('error', $this->authService->getErrors());
            header('Location: /ESSEMLALI-Bank/login');
            exit;
        }
        $role = Session::get('user')['role'];
        $this->redirectUserByRole($role);
    }

    private function redirectUserByRole($role){
        return match ($role) {
            'Admin' =>  $this->twig->render('admin/index.html.twig',['session' => $_SESSION]),
            'Employé' => $this->twig->render('employe/index.html.twig',['session' => $_SESSION]),
            'client' => $this->twig->render('client/login.html.twig',['session' => $_SESSION]),
            default => "unknown" 
        };
    }
    

    
}