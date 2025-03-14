<?php 
namespace App\Controllers;
use App\core\Session;
use App\services\AdminService;
use App\requests\StoreAdminRequest;

class AdminController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
          $this->adminService= new AdminService();
          Session::start();

    }


    public function index()
    {
       echo  $this->twig->render('admin/index.twig',['session' => $_SESSION]);

    }
    public function admin()
    {
       echo  $this->twig->render('admin/admins.twig',['session' => $_SESSION]);

    }
    
    public function addAdmin()
{
    $request = new StoreAdminRequest($_POST);
    if (!$request->validate()) {
        Session::set('error', $request->getErrors());
        Session::set('values', $_POST);
        header('Location: /ESSEMLALI-Bank/admins');
        exit;
    }
    Session::unset('error');
    $data = [
        "nom" => trim($_POST["nom"]),
        "prenom" => trim($_POST["prenom"]),
        "email" => trim($_POST["email"]),
        "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT) ,
        "is_active"=>true 
    ];
    if (!$this->adminService->addAdmin($data)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
        header('Location: /ESSEMLALI-Bank/admins');
        exit;
    }
    header('Location: /ESSEMLALI-Bank/admins');
    exit;
}
}