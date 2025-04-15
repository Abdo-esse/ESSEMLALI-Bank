<?php

namespace App\Controllers;
use App\services\TransactionService;
use App\services\HistoriqueService;
use App\requests\DepositRequest;
use App\requests\RetraitRequest;
use App\requests\VirementRequest;
use App\core\Session;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    private HistoriqueService $historiqueService;
    public function __construct()
    {
          parent::__construct();
          $this->transactionService= new TransactionService;
          $this->historiqueService= new HistoriqueService;
    }

    

    public function deposit(){
        $request = new DepositRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorDeposit', $request->getErrors());
             $this->redirect('versement');
            exit;
        }
        Session::unset('errorDeposit');
        if(!$this->transactionService->updateBalance( $_POST["account_number"], $_POST["amount"])){
            Session::set('error', "Une erreur s'est produite lors de depose l'argent.");
             $this->redirect('versement');
            exit;
        }
        $this->historiqueService->saveHistorique($_POST,"Deposit");
         $this->redirect('versement');
        exit;

        
    }

    public function retrait(){
        $request = new RetraitRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorRetrait', $request->getErrors());
             $this->redirect('retrait');
            exit;
        }
        Session::unset('errorRetrait');
        if(!$this->transactionService->updateBalance( $_POST["account_number"], -$_POST["amount"])){
            Session::set('error', "Une erreur s'est produite lors de retrait l'argent.");
             $this->redirect('retrait');
            exit;
        }
         $this->historiqueService->saveHistorique($_POST,"Retrait");
         $this->redirect('retrait');
        exit;

        
    }
    public function virement(){
        var_dump($_POST);
        $request = new VirementRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorVirement', $request->getErrors());
             $this->redirect('virement');
            exit;
        }
        Session::unset('errorVirement');        
        if(!$this->transactionService->virement( $_POST)){
            Session::set('error', "Une erreur s'est produite lors de virement l'argent.");
             $this->redirect('virement');
            exit;
        }
         $this->historiqueService->saveHistoriqueVirement($_POST);
         $this->redirect('recu/virement');
        exit;

        
    }

    public function recuVirement(){
        echo  $this->twig->render('reçu/virement.twig',['session' => $_SESSION ]);
    }


    



    
}