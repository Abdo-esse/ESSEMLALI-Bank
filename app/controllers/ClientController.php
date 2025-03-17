<?php

namespace App\Controllers;
use App\core\Session;
use App\requests\SignInRequest;

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
           'session' => $_SESSION,
       ]);

    }
    public function store()
    {
        // $request = new SignInRequest($_POST);
        // if (!$request->validate()) {
        //     Session::set('errorClient', $request->getErrors());
        //     Session::set('valuesClient', $_POST);
        //     header('Location: /ESSEMLALI-Bank/signIn');
        //     var_dump($request->getErrors());
        //     echo "matvalidawx";
        //     exit;
        // }
        // Session::unset('errorClient');
        // Session::unset('valuesClient');
        // $data = [
        //     "nom" => trim($_POST["nom"]),
        //     "prenom" => trim($_POST["prenom"]),
        //     "email" => trim($_POST["email"]),
        //     "is_active"=>true 
        // ];
        echo '<pre>';
        var_dump($_FILES);
        echo '<pre>';

            $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
            move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
      
        echo '<pre>';
        var_dump(pathinfo($filePath));
        echo '<pre>';

        // if (!$this->adminService->create($data)) {
        //     Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
        //     header('Location: /ESSEMLALI-Bank/admins');
        //     exit;
        // }
        // header('Location: /ESSEMLALI-Bank/admins');
        exit;
    }
    



    
}