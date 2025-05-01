<?php

namespace App\Controllers;

use App\services\AuthService;
use App\requests\LoginRequest;
use App\core\Session;

class LoginController extends Controller
{
    private $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }


    public function index()
    { 
        $errors = Session::getFlash("error");
        $values = Session::getFlash("valueslogin");
        $loginError = Session::getFlash("login"); 
    
        echo $this->twig->render('auth/login.twig', [
            'session' => $_SESSION,
            'error' => $errors,
            'valueslogin' => $values,
            'login' => $loginError
        ]);

    }

    public function login()
    {
        $request = new LoginRequest($_POST);

        if (!$request->validate()) {
            Session::setFlash('error', $request->getErrors());
            Session::setFlash('valueslogin', $_POST);
            $this->redirect('login');
            exit;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!$this->authService->login($email, $password)) {
            $this->redirect('login');
            exit;
        }
        $role = Session::get('user')['role'];
        $this->redirectUserByRole($role);
    }


    private function redirectUserByRole($role)
    {
        return match ($role) {
            'Admin' => $this->redirect('accueil-admin'),
            'Employé' => $this->redirect('accueil-employe'),
            'Client' => $this->redirect('client'),
            default => "unknown"
        };
    }


    public function logout(){
        Session::destroy();
        $this->redirect('');
    }


}