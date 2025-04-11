<?php

namespace App\Controllers;
use App\core\Session;
use App\requests\SignInRequest;
use App\requests\UpdateClientRequest;
use App\services\ClientService;
use App\services\CompteService;

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

    public function index()
    {
       echo  $this->twig->render('client/index.twig',['session' => $_SESSION ]);
    }
    public function edite($id)
    {
        $client=$this->clientService->getClient($id);
        //  Session::set('password', $client['client']->getMotDePasse());
        echo  $this->twig->render('client/updateinfo.twig',[
            'session' => $_SESSION,
            'client' => $client,
         ]);
    }
    public function update($id)
    {
        
        $client = $this->clientService->findclient($id);
        $_POST["motDePassEnregister"]=$client['mot_de_passe'];
        $request = new UpdateClientRequest($_POST);
    if (!$request->validate()) {
        Session::set('errorEditClient', $request->getErrors());
        header("Location: /ESSEMLALI-Bank/client/update/$id");
        exit;
    }
    Session::unset('errorEditClient');
    // $data = [
    //     "nom" => trim($_POST["nom"]),
    //     "prenom" => trim($_POST["prenom"]),
    //     "email" => trim($_POST["email"]),
    //     "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT),
    //     "date_modification" => date('Y-m-d H:i:s') 
    // ];
    
    // if (!$this->employeService->update($id,$data)) {
    //     Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
    //     header('Location: /ESSEMLALI-Bank/Client');
    //     exit;
    // }

    // header('Location: /ESSEMLALI-Bank/Client');
    // echo "mzyan";
    exit;
    }
    

    public function create()
    {
       echo  $this->twig->render('auth/signIn.twig', [
           'session' => $_SESSION,
       ]);

    }
    private function addClients($where){
        $request = new SignInRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorClient', $request->getErrors());
            Session::set('valuesClient', $_POST);
            header("Location: /ESSEMLALI-Bank/$where");
            exit;
        }
        Session::unset('errorClient');
        Session::unset('valuesClient');
        $fileName = uniqid() . '_' . $_FILES['carte_identite']['name'];
        $uploadPath = __DIR__ . '/../../public/uploads/' . $fileName;

        if (move_uploaded_file($_FILES['carte_identite']['tmp_name'], $uploadPath)) {
            $_POST['carte_identite'] = $fileName;
        }

        $clientId=$this->clientService->create();
        if (!$clientId) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de client.");
           header("Location: /ESSEMLALI-Bank/$where");
        }
         return $clientId;
    }
    public function store()
    {
        $this->addClients("signIn");

        header('Location: /ESSEMLALI-Bank');
        exit;
    }

    public function add()
    {
        $clientId=$this->addClients("demandeCompte");
        if($clientId){
         $compteService=new CompteService();
         if($compteService->approuver($clientId)){
            header('Location: /ESSEMLALI-Bank/demandeCompte');
             exit;
         }

        }



    }
    public function demandeComptes(){
        $clients=$this->clientService->getAll();
        echo  $this->twig->render('employe/demandeComptes.twig', [
            'clients' => $clients,
        ]);
    }
    public function demandeCompte($id){
        $client=$this->clientService->find($id);
        echo  $this->twig->render('employe/demandeCompte.twig', [
            'client' => $client,
        ]);
    }
    public function clients(){
        $clients=$this->clientService->allClients();
        echo  $this->twig->render('employe/clients.twig', [
            'clients' => $clients,
        ]);
    }
    public function client($id){
        $client=$this->clientService->getClient($id);
        echo  $this->twig->render('employe/client.twig', [
            'client' => $client,
        ]);
    }
    public function delete($id){
        $data = [
            "is_active"=>"false" ,
            "date_suppression"=>date('Y-m-d H:i:s') 
        ];
        
        if (!$this->clientService->update($id,$data)) {
            Session::set('error', "Une erreur s'est produite lors de la supression de client.");
            header('Location: /ESSEMLALI-Bank/client/'.$id);
            exit;
        }
        header('Location: /ESSEMLALI-Bank/clients');
        exit;
    } 

    



    
}