<?php

namespace App\Controllers;
use App\core\Session;
use App\requests\SignInRequest;

class ClientController
{
    private $twig;
    private ClientService $clientService;

    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
          $this->clientService=new ClientService();
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
        $request = new SignInRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorClient', $request->getErrors());
            Session::set('valuesClient', $_POST);
            header('Location: /ESSEMLALI-Bank/signIn');
            exit;
        }
        Session::unset('errorClient');
        Session::unset('valuesClient');
        $fileName = uniqid() . '_' . $_FILES['carte_identite']['name'];
        $uploadPath = __DIR__ . '/../../public/uploads/' . $fileName;

        if (move_uploaded_file($_FILES['carte_identite']['tmp_name'], $uploadPath)) {
            $_POST['carte_identite'] = $fileName;
        }
         
        if (!$this->clientService->create($_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de client.");
            header('Location: /ESSEMLALI-Bank/signIn');
            exit;
        }
        header('Location: /ESSEMLALI-Bank/admins');
        exit;
    }
    



    
}