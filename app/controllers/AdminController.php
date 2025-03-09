<?php 
namespace App\Controllers;
use App\core\Session;

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
       echo  $this->twig->render('admin/index.html.twig',['session' => $_SESSION]);

    }
}