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
        if ($this->comptService->approuver($id)) {
            header('Location: /ESSEMLALI-Bank/clients');
            exit;
        }

    }
    public function refuser($id)
    {
        if ($this->comptService->refuser($id)) {
            header('Location: /ESSEMLALI-Bank/clients');
            exit;
          }  

    }


    



    
}