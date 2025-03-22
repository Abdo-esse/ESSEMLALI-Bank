<?php

namespace App\Controllers;
use App\core\Session;
use App\requests\SignInRequest;
use App\services\ClientService;

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
      
        if (!$this->clientService->create()) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de client.");
            header('Location: /ESSEMLALI-Bank/signIn');
            exit;
        }
        header('Location: /ESSEMLALI-Bank');
        exit;
    }

    public function clients(){
        $clients=$this->clientService->getAll();
        echo  $this->twig->render('employe/clients.twig', [
            'clients' => $clients,
        ]);
    }
    public function client($id){
        $client=$this->clientService->find($id);
        $file_path =dirname(__DIR__). "/../uploads/67d85dd5aaa67_Capture d'écran 2024-12-22 001846.png";
        $client->setCarteIdentite($file_path);
        echo  $this->twig->render('employe/client.twig', [
            'client' => $client,
        ]);

        if (!is_readable($client->getCarteIdentite())) {
            echo "🚨 Problème de permissions sur le fichier.";
           var_dump( $client->getCarteIdentite());

        } else {
            echo "✅ Le fichier est accessible.";
           var_dump( $client->getCarteIdentite());

        }
    }


    



    
}