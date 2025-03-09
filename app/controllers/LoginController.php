<?php

namespace App\Controllers;

class LoginController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
    }


    public function index()
    {
       echo  $this->twig->render('auth/login.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    



    
}