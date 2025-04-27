<?php

namespace App\Controllers;

use App\services\EmployeService;
use App\services\StatistiqueService;
use App\requests\StoreUserRequest;
use App\core\Session;

class EmployeController extends Controller
{
    private $employeService;
    private $statistiqueService;

    public function __construct()
    {
        parent::__construct();
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
        echo $this->twig->render('admin/eployes.twig', ['session' => $_SESSION,]);
    }

    public function create()
    {
        $request = new StoreUserRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorEmployer', $request->getErrors());
            Session::set('valuesEmployer', $_POST);
            $this->redirect('employes');
            exit;
        }
        Session::unset('errorEmployer');
        Session::unset('valuesEmployer');
        if (!$this->employeService->create($_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
            $this->redirect('employes');
            exit;
        }

        $this->redirect('employes');
        exit;
    }

    public function edite($id)
    {
        $employe = $this->employeService->find($id);
        if ($employe) {
            echo $this->twig->render('admin/editeEploye.twig', [
                'session' => $_SESSION,
                'employe' => $employe
            ]);

        }

    }

    public function update($id)
    {
        $request = new StoreUserRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorEditEmployer', $request->getErrors());
            $this->redirect("editeEploye/$id");
            exit;
        }
        Session::unset('errorEditEmployer');
        if (!$this->employeService->update($id, $_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
            $this->redirect('employes');
            exit;
        }

        $this->redirect('employes');
        exit;
    }

    public function desactiver($id)
    {
        $data = ["is_active" => "false"];
        if (!$this->employeService->update($id, $data)) {
            Session::set('error', "Une erreur s'est produite lors de desactiver de l'employer.");
            $this->redirect('employes');
            exit;
        }
        $this->redirect('employes');
        exit;
    }

    public function activer($id)
    {
        $data = ["is_active" => "true"];
        if (!$this->employeService->update($id, $data)) {
            Session::set('error', "Une erreur s'est produite lors de activer de l'employer.");
            $this->redirect('employes');
            exit;
        }
        $this->redirect('employes');
        exit;
    }

    public function delete($id)
    {
        $data = ["is_active" => "false", "date_suppression" => date('Y-m-d H:i:s')];
        if (!$this->employeService->update($id, $data)) {
            Session::set('error', "Une erreur s'est produite lors de la supression de l'employer.");
            $this->redirect('employes');
            exit;
        }
        $this->redirect('employes');
        exit;
    }

    public function allEmployes()
    {
        $employes = $this->employeService->getAll();
        echo json_encode($employes);
    }

    public function searchEmployes()
    {
        if (isset($_GET["keyword"])) {
            $keyword = $_GET["keyword"];
        }
        $employes = $this->employeService->searchEmployes($keyword);
        echo json_encode($employes);
    }


}