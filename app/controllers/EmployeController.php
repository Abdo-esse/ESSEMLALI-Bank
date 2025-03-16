<?php 
namespace App\Controllers;
use App\core\Session;
use App\services\EmployeService;
use App\requests\StoreUserRequest;

class EmployeController
{
    private $twig;
    private $employeService;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
          $this->employeService= new EmployeService();
          Session::start();

    }


    // public function index()
    // {
    //    echo  $this->twig->render('admin/index.twig',['session' => $_SESSION ]);
    // }
    public function employes()
    {
        $employes= $this->employeService->getAllEmployes();
       echo  $this->twig->render('admin/eployes.twig',[
           'session' => $_SESSION,
           'employes'=>$employes
       ]);

    }
    
    public function addEmploye()
{
    $request = new StoreUserRequest($_POST);
    if (!$request->validate()) {
        Session::set('errorEmployer', $request->getErrors());
        Session::set('valuesEmployer', $_POST);
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }
    Session::unset('errorEmployer');
    Session::unset('valuesEmployer');
    $data = [
        "nom" => trim($_POST["nom"]),
        "prenom" => trim($_POST["prenom"]),
        "email" => trim($_POST["email"]),
        "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT) ,
        "is_active"=>true 
    ];
    if (!$this->employeService->Addemploye($data)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
}

public function updateEmploye($id){
    echo"$id";

}
}