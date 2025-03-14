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

    // Validation des données
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
        "password" => password_hash($_POST["password"], PASSWORD_DEFAULT) // Sécurisation du mot de passe
    ];
    if (!$this->adminService->addAdmin($data)) {
      //   Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
      //   header('Location: /ESSEMLALI-Bank/admins');
      echo"Une erreur s'est produite lors de l'ajout de l'administrateur.";
        exit;
    }
    header('Location: /ESSEMLALI-Bank/admins');
    exit;
}
}