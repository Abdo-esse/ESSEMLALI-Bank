<?php 
namespace App\Controllers;


class PagesController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
    }


    public function index()
    {
       echo  $this->twig->render('pages/home.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    public function apropos()
    {
       echo  $this->twig->render('pages/apropos.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    public function prets()
    {
       echo  $this->twig->render('pages/prets.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
}