<?php 
namespace App\Controllers;
require dirname( __DIR__) . '/../vendor/autoload.php';
use App\Core\View;

class HomeController
{


    public function index()
    {
    //     $data['titel']="home page";
    //     $data['contentent']="home page hdhdh uzeaufiytz jvcytqfd  ukefzit ";
    //    View::load("/Apropos",$data);
       // Charger Twig depuis la configuration
       $twig = require_once dirname( __DIR__) .'/config/Twig.php';

       // Rendre la vue home.html.twig et passer des variables
       echo $twig->render('Apropos.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
}