<?php

namespace App\Controllers;
use App\services\CompteService;
use App\requests\DepositRequest;
use App\core\Session;

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

    

    public function deposit(){
        $request = new DepositRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorDeposit', $request->getErrors());
            Session::set('valuesDeposit', $_POST);
            header('Location: /ESSEMLALI-Bank/versement');
            exit;
        }
        Session::unset('errorDeposit');
        Session::unset('valuesDeposit');
        if(!$this->comptService->deposit()){
            Session::set('error', "Une erreur s'est produite lors de depose l'argent.");
            header('Location: /ESSEMLALI-Bank/versement');
            exit;
        }
        header('Location: /ESSEMLALI-Bank/versement');
        exit;

        
    }


    



    
}