<?php

namespace App\Controllers;

class CompteController
{
    private $twig;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
    }


    public function demandeCompte()
    {
       echo  $this->twig->render('auth/demadeCompte.html.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    



    
}