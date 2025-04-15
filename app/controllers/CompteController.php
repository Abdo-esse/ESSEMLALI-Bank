<?php

namespace App\Controllers;
use App\services\CompteService;
use App\services\TransactionService;
use App\services\HistoriqueService;
use App\requests\DepositRequest;
use App\requests\RetraitRequest;
use App\core\Session;

class CompteController extends Controller
{
    private CompteService $comptService;
    private TransactionService $transactionService;
    private HistoriqueService $historiqueService;
    public function __construct()
    {
          parent::__construct();
          $this->comptService= new CompteService;
          $this->transactionService= new TransactionService;
          $this->historiqueService= new HistoriqueService;
    }


    public function demandeCompte()
    {
       echo  $this->twig->render('auth/demadeCompte.twig');

    }
    public function approuver($id)
    {
        if ($this->comptService->approuver($id)) {
             $this->redirect('clients');
            exit;
        }

    }
    public function refuser($id)
    {
        if ($this->comptService->refuser($id)) {
             $this->redirect('clients');
            exit;
          }  

    }


    
}