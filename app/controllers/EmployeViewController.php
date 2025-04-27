<?php

namespace App\Controllers;

use App\services\ClientService;
use App\services\EmployeService;
use App\services\StatistiqueService;
use App\core\Session;

class EmployeViewController extends Controller
{
    private ClientService $clientService;
    private $employeService;
    private $statistiqueService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService = new ClientService();
        $this->employeService = new EmployeService();
        $this->statistiqueService = new StatistiqueService();
    }

    public function index()
    {
        $data = $this->statistiqueService->statistiqueEmploye();
        echo $this->twig->render('employe/index.twig', ['session' => $_SESSION, "data" => $data]);
    }

    public function employes()
    {
        echo $this->twig->render('admin/eployes.twig',
        [
            'session' => $_SESSION,
            'valuesEmployer'=>Session::getFlash("valuesEmployer"),
            'errorEmployer'=>Session::getFlash("errorEmployer")
        ]);
    }


    public function demandeComptes()
    {

        echo $this->twig->render('employe/demandeComptes.twig',
        [
            'session' => $_SESSION,
            'errorClient'=>Session::getFlash("errorClient"),
            'valuesClient'=>Session::getFlash("valuesClient")
        ]);
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


    public function edite($id)
    {
        $employe = $this->employeService->find($id);
        if ($employe) {
            echo $this->twig->render('admin/editeEploye.twig', [
                'session' => $_SESSION,
                'employe' => $employe,
                'errorEditEmployer'=>Session::getFlash("errorEditEmployer")
            ]);

        }

    }


}