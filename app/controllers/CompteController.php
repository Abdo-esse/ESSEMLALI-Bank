<?php

namespace App\Controllers;
use App\services\CompteService;

class CompteController
{
    private $twig;
    private CompteService $comptService;
    public function __construct()
    {
          $this->twig= require_once dirname( __DIR__) .'/config/Twig.php';
          $this->comptService= new CompteService;
    }


    public function demandeCompte()
    {
       echo  $this->twig->render('auth/demadeCompte.twig', [
           'variable1' => 'Valeur 1',
           'variable2' => 'Valeur 2',
       ]);

    }
    public function approuver($id)
    {
        $this->comptService->approuver($id);

    }
    public function refuser($id)
    {
       

    }


    



    
}