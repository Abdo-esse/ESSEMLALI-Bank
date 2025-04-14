<?php 
namespace App\Controllers;

use App\services\AdminService;
use App\requests\StoreUserRequest;
use App\core\Session;
class AdminController extends Controller
{
   
    private $adminService;
    public function __construct()
    {      
        parent::__construct();  
        $this->adminService= new AdminService(); 
    }


    public function index()
    {
       echo  $this->twig->render('admin/index.twig',['session' => $_SESSION ]);
    }
    public function admin()
    {
        $admins= $this->adminService->getAll();
       echo  $this->twig->render('admin/admins.twig',[
           'session' => $_SESSION,
           'admins'=>$admins
       ]);

    }
    
    public function create()
{
    $request = new StoreUserRequest($_POST);
    if (!$request->validate()) {
        Session::set('error', $request->getErrors());
        Session::set('values', $_POST);
         $this->redirect('admins');
        exit;
    }
    Session::unset('error');
    Session::unset('values');
    $data = [
        "nom" => trim($_POST["nom"]),
        "prenom" => trim($_POST["prenom"]),
        "email" => trim($_POST["email"]),
        "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT) ,
        "is_active"=>true 
    ];
    if (!$this->adminService->create($data)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
         $this->redirect('admins');
        exit;
    }
     $this->redirect('admins');
    exit;
}
}