<?php

namespace App\Controllers;

use App\services\ClientService;
use App\core\Session;

class EmployeViewController extends Controller
{
    private ClientService $clientService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService = new ClientService();
    }


    public function demandeComptes()
    {

        echo $this->twig->render('employe/demandeComptes.twig');
    }

    public function demandeCompte($id)
    {
        $client = $this->clientService->find($id);
        echo $this->twig->render('employe/demandeCompte.twig', ['client' => $client,]);
    }

    public function clients()
    {
        $clients = $this->clientService->allClients();
        echo $this->twig->render('employe/clients.twig');
    }

    public function client($id)
    {
        $client = $this->clientService->getClient($id);
        echo $this->twig->render('employe/client.twig', ['client' => $client,]);
    }


}