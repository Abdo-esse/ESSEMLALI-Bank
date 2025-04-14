<?php

namespace App\Controllers; 

use App\services\AuthService; 
use App\requests\LoginRequest;
use App\core\Session;

class LoginController extends Controller{
    private $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
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
            $this->redirect('login');
            exit;
        }
        Session::unset('error');
        Session::unset('valueslogin');
        $email = $_POST['email'] ;
        $password = $_POST['password'] ;
        if (!$this->authService->login($email, $password)) {
            $this->redirect('login');
            exit;
        }
        $role = Session::get('user')['role'];
         $this->redirectUserByRole($role);
    }


    private function redirectUserByRole($role){
        return match ($role) {
            'Admin' => $this->redirect('Admin'),
            'Employé' => $this->redirect('Employe'),
            'Client' => $this->redirect('Client'),
            default => "unknown" 
        };
    }
    

    
}