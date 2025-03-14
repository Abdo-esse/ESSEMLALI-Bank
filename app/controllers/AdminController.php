<?php 
namespace App\Controllers;
use App\core\Session;
use App\requests\StoreAdminRequest;
class AdminController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
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
            header('Location: /ESSEMLALI-Bank/admins');
            exit;
      }
      Session::unset('error');
      echo "3la molana";
      exit();
    }
}