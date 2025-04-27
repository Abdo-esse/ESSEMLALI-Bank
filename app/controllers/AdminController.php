<?php

namespace App\Controllers;

use App\services\AdminService;
use App\services\StatistiqueService;
use App\requests\StoreUserRequest;
use App\core\Session;

class AdminController extends Controller
{

    private $adminService;
    private $statistiqueService;

    public function __construct()
    {
        parent::__construct();
        $this->adminService = new AdminService();
        $this->statistiqueService = new StatistiqueService();
    }


    public function index()
    {
        $id = $_SESSION["user"]["id"];
        $data = $this->statistiqueService->statistiqueAdmin();
        $admin=$this->adminService->findById($id);
        echo $this->twig->render('admin/index.twig',
        [
            'session' => $_SESSION,
            "data" => $data,
            'name'=> $admin->getNom(),
            'prenom'=>$admin->getprenom()
        ]);
    }

    public function admin()
    {
        $admins = $this->adminService->getAll();

        echo $this->twig->render('admin/admins.twig',
         [
            'session' => $_SESSION,
            'admins' => $admins,
            'error'=> Session::getFlash("error"),
            'values'=> Session::getFlash("values")
        ]);

    }

    public function create()
    {
        $request = new StoreUserRequest($_POST);
        if (!$request->validate()) {
            Session::setFlash('error', $request->getErrors());
            Session::setFlash('values', $_POST);
            $this->redirect('admins');
            exit;
        }
        if (!$this->adminService->create($_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
            $this->redirect('admins');
            exit;
        }
        $this->redirect('admins');
        exit;
    }
}