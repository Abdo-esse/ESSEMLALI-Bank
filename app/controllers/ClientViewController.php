<?php

namespace App\Controllers;

use App\requests\SignInRequest;
use App\requests\UpdateClientRequest;
use App\services\ClientService;
use App\services\CompteService;
use App\services\HistoriqueService;
use App\core\Session;
class ClientViewController extends Controller
{
    private ClientService $clientService;
    private HistoriqueService $historiqueService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService=new ClientService();
        $this->historiqueService= new HistoriqueService();
    }
    

    public function index()
    {
        $id= $_SESSION["user"]["id"];
        $client=$this->clientService->getClient($id);
        $historiques=$this->historiqueService->getHistorique(22);
       echo  $this->twig->render('client/index.twig',['session' => $_SESSION,'client' => $client,'historiques' => $historiques ]);
    }

    public function edite()
    {
        $id= $_SESSION["user"]["id"];      
        $client=$this->clientService->getClient($id);
        echo  $this->twig->render('client/updateinfo.twig',['session' => $_SESSION,'client' => $client]);
    }
   
    

    public function create()
    {
       echo  $this->twig->render('auth/signIn.twig', ['session' => $_SESSION]);
    }   

 
    public function demandeComptes(){
        $clients=$this->clientService->getAll();
        echo  $this->twig->render('employe/demandeComptes.twig', ['clients' => $clients]);
    }
    public function demandeCompte($id){
        $client=$this->clientService->find($id);
        echo  $this->twig->render('employe/demandeCompte.twig', ['client' => $client,]);
    }
    public function clients(){
        $clients=$this->clientService->allClients();
        echo  $this->twig->render('employe/clients.twig', ['clients' => $clients,]);
    }
    public function client($id){
        $client=$this->clientService->getClient($id);
        echo  $this->twig->render('employe/client.twig', ['client' => $client,]);
    }
 

    



    
}