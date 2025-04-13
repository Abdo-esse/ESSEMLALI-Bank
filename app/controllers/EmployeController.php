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


    public function index()
    {
       echo  $this->twig->render('employe/index.twig',['session' => $_SESSION ]);
    }
    public function versementView()
    {
       echo  $this->twig->render('employe/versement.twig',['session' => $_SESSION ]);
    }
    public function employes()
    {
        $employes= $this->employeService->getAll();
       echo  $this->twig->render('admin/eployes.twig',[
           'session' => $_SESSION,
           'employes'=>$employes
       ]);

    }
    
    public function create()
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
    if (!$this->employeService->create($data)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'administrateur.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
}

   public function edite($id){
    $employe= $this->employeService->find($id);
    if($employe){
        echo  $this->twig->render('admin/editeEploye.twig',[
            'session' => $_SESSION,
            'employe'=>$employe
        ]);

    }

}

public function update($id)
{
    $request = new StoreUserRequest($_POST);
    if (!$request->validate()) {
        Session::set('errorEditEmployer', $request->getErrors());
        header("Location: /ESSEMLALI-Bank/editeEploye/$id");
        exit;
    }
    Session::unset('errorEditEmployer');
    $data = [
        "nom" => trim($_POST["nom"]),
        "prenom" => trim($_POST["prenom"]),
        "email" => trim($_POST["email"]),
        "mot_de_passe" => password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT),
        "date_modification" => date('Y-m-d H:i:s') 
    ];
    
    if (!$this->employeService->update($id,$data)) {
        Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
} 
public function desactiver($id)
{
    $data = [
        "is_active"=>"false" 
    ];
    
    if (!$this->employeService->update($id,$data)) {
        Session::set('error', "Une erreur s'est produite lors de desactiver de l'employer.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
} 
public function activer($id)
{
    $data = [
        "is_active"=>"true" 
    ];
    
    if (!$this->employeService->update($id,$data)) {
        Session::set('error', "Une erreur s'est produite lors de activer de l'employer.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
} 
public function delete($id)
{
    $data = [
        "is_active"=>"false" ,
        "date_suppression"=>date('Y-m-d H:i:s') 
    ];
    
    if (!$this->employeService->update($id,$data)) {
        Session::set('error', "Une erreur s'est produite lors de la supression de l'employer.");
        header('Location: /ESSEMLALI-Bank/employes');
        exit;
    }

    header('Location: /ESSEMLALI-Bank/employes');
    exit;
} 



}