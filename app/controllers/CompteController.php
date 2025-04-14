<?php

namespace App\Controllers;
use App\services\CompteService;
use App\services\TransactionService;
use App\requests\DepositRequest;
use App\requests\RetraitRequest;
use App\core\Session;

class CompteController extends Controller
{
    private CompteService $comptService;
    private TransactionService $transactionService;
    public function __construct()
    {
          parent::__construct();
          $this->comptService= new CompteService;
          $this->transactionService= new TransactionService;
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
            header('Location: /ESSEMLALI-Bank/versement');
            exit;
        }
        Session::unset('errorDeposit');
        if(!$this->transactionService->updateBalance( $_POST["account_number"], $_POST["amount"])){
            Session::set('error', "Une erreur s'est produite lors de depose l'argent.");
            header('Location: /ESSEMLALI-Bank/versement');
            exit;
        }
        header('Location: /ESSEMLALI-Bank/versement');
        exit;

        
    }

    public function retrait(){
        $request = new RetraitRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorRetrait', $request->getErrors());
            header('Location: /ESSEMLALI-Bank/retrait');
            exit;
        }
        Session::unset('errorRetrait');
        if(!$this->transactionService->updateBalance( $_POST["account_number"], -$_POST["amount"])){
            Session::set('error', "Une erreur s'est produite lors de depose l'argent.");
            header('Location: /ESSEMLALI-Bank/retrait');
            exit;
        }
        header('Location: /ESSEMLALI-Bank/retrait');
        exit;

        
    }


    



    
}