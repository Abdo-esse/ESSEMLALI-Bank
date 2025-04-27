<?php

namespace App\Controllers;

use App\services\EmployeService;
use App\services\StatistiqueService;
use App\requests\StoreUserRequest;
use App\requests\UpdateUserRequest;
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

    public function create()
    {
        $request = new StoreUserRequest($_POST);
        if (!$request->validate()) {
            Session::setFlash('errorEmployer', $request->getErrors());
            Session::setFlash('valuesEmployer', $_POST);
            $this->redirect('employes');
            exit;
        }
        if (!$this->employeService->create($_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
            $this->redirect('employes');
            exit;
        }

        $this->redirect('employes');
        exit;
    }

    public function update($id)
    {
        $request = new UpdateUserRequest($_POST);
        if (!$request->validate()) {
            Session::setFlash('errorEditEmployer', $request->getErrors());
            $this->redirect("edite-eploye/$id");
            exit;
        }
        if (!$this->employeService->update($id, $_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'update de l'employer.");
            $this->redirect('employes');
            exit;
        }

        $this->redirect('employes');
        exit;
    }

    public function desactiver($id)
    {
        $data = ["is_active" => "false"];
        if (!$this->employeService->activerDesactiver($id, $data)) {
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
        if (!$this->employeService->activerDesactiver($id, $data)) {
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