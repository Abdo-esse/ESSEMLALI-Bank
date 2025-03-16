<?php

namespace App\Controllers;

class ClientController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
    }


    public function create()
    {
       echo  $this->twig->render('auth/signIn.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    



    
}