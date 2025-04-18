<?php

namespace App\Controllers;

use App\requests\SignInRequest;
use App\requests\UpdateClientRequest;
use App\services\ClientService;
use App\services\CompteService;
use App\core\Session;
class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService=new ClientService();
    }
    public function update($id)
    {
        
        $client = $this->clientService->findclient($id);
        $_POST["motDePassEnregister"]=$client['mot_de_passe'];
        $request = new UpdateClientRequest($_POST);
    if (!$request->validate()) {
        Session::set('errorEditClient', $request->getErrors());
         $this->redirect("client/update/$id");
        exit;
    }
    Session::unset('errorEditClient');   
    if (!$this->clientService->update($id,$_POST)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
         $this->redirect('Client');
        exit;
    }

     $this->redirect('Client');
    exit;
    }
    
    private function addClients($where){
        $request = new SignInRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorClient', $request->getErrors());
            Session::set('valuesClient', $_POST);
             $this->redirect("$where");
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
            $this->redirect("$where");
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
             $this->redirect('demandeCompte');
             exit;
         }

        }
    }
    
    public function delete($id){
        $data = [
            "is_active"=>"false" ,
            "date_suppression"=>date('Y-m-d H:i:s') 
        ];
        
        if (!$this->clientService->update($id,$data)) {
            Session::set('error', "Une erreur s'est produite lors de la supression de client.");
             $this->redirect('client/'.$id);
            exit;
        }
         $this->redirect('clients');
        exit;
    } 

    



    
}