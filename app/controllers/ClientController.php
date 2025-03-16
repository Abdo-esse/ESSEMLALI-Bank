<?php

namespace App\Controllers;
use App\core\Session;

class ClientController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
          Session::start();

    }


    public function create()
    {
       echo  $this->twig->render('auth/signIn.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    public function store()
    {
        $request = new StoreUserRequest($_POST);
        if (!$request->validate()) {
            Session::set('error', $request->getErrors());
            Session::set('values', $_POST);
            header('Location: /ESSEMLALI-Bank/admins');
            exit;
        }
        Session::unset('error');
        Session::unset('values');
        $data = [
            "nom" => trim($_POST["nom"]),
            "prenom" => trim($_POST["prenom"]),
            "email" => trim($_POST["email"]),
            "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT) ,
            "is_active"=>true 
        ];
        if (!$this->adminService->create($data)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
            header('Location: /ESSEMLALI-Bank/admins');
            exit;
        }
        header('Location: /ESSEMLALI-Bank/admins');
        exit;
    }
    



    
}