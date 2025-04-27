<?php

namespace App\Controllers;

use App\services\ClientService;
use App\services\HistoriqueService;
use App\core\Session;

class ClientViewController extends Controller
{
    private ClientService $clientService;
    private HistoriqueService $historiqueService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService = new ClientService();
        $this->historiqueService = new HistoriqueService();
    }


    public function index()
    {
        $id = $_SESSION["user"]["id"];
        $client = $this->clientService->getClient($id);
        $historiques = $this->historiqueService->getHistorique($id);
        echo $this->twig->render('client/index.twig', ['session' => $_SESSION, 'client' => $client, 'historiques' => $historiques]);
    }

    public function edite()
    {
        $id = $_SESSION["user"]["id"];
        $client = $this->clientService->getClient($id);
        echo $this->twig->render('client/updateinfo.twig', ['session' => $_SESSION, 'client' => $client]);
    }

    public function create()
    {
        echo $this->twig->render('auth/signIn.twig', ['session' => $_SESSION]);
    }

    public function releve()
    {
        $id = $_SESSION["user"]["id"];
        $client = $this->clientService->getClient($id);
        echo $this->twig->render('client/releveCompte.twig', ['session' => $_SESSION, 'client' => $client]);
    }


}