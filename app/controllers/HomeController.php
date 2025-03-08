<?php 
namespace App\Controllers;
require dirname( __DIR__) . '/../vendor/autoload.php';
use App\Core\View;

class HomeController
{


    public function index()
    {
        $data['titel']="home page";
        $data['contentent']="home page hdhdh uzeaufiytz jvcytqfd  ukefzit ";
       View::load("/pages/home",$data);

    }
}