<?php

namespace App\Controllers;

use App\services\TransactionService;
use App\services\HistoriqueService;
use App\services\ClientService;
use App\requests\DepositRequest;
use App\requests\RetraitRequest;
use App\requests\VirementRequest;
use App\core\Session;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    private HistoriqueService $historiqueService;
    private ClientService $clientService;

    public function __construct()
    {
        parent::__construct();
        $this->transactionService = new TransactionService;
        $this->historiqueService = new HistoriqueService;
        $this->clientService = new ClientService();
    }


    public function deposit()
    {
        $request = new DepositRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorDeposit', $request->getErrors());
            Session::set('dataDeposit', $_POST);
            $this->redirect('versement');
            exit;
        }
        Session::unset('errorDeposit');
        Session::unset('dataDeposit');
        if (!$this->transactionService->updateBalance($_POST["account_number"], $_POST["amount"])) {
            Session::set('error', "Une erreur s'est produite lors de depose l'argent.");
            $this->redirect('versement');
            exit;
        }
        $this->historiqueService->saveHistorique($_POST, "Deposit");
        Session::set("post", $_POST);
        $this->redirect('recu/versement');
        exit;


    }

    public function retrait()
    {
        $request = new RetraitRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorRetrait', $request->getErrors());
            Session::set('dataRetrait', $_POST);
            $this->redirect('retrait');
            exit;
        }
        Session::unset('errorRetrait');
        Session::unset('dataRetrait');
        if (!$this->transactionService->updateBalance($_POST["account_number"], -$_POST["amount"])) {
            Session::set('error', "Une erreur s'est produite lors de retrait l'argent.");
            $this->redirect('retrait');
            exit;
        }
        $this->historiqueService->saveHistorique($_POST, "Retrait");
        Session::set("post", $_POST);
        $this->redirect('recu/retrait');
        exit;


    }

    public function virementEmploye()
    {
        $this->virement('virement');
    }

    public function virementClient()
    {
        $id = $_SESSION["user"]["id"];
        $client = $this->clientService->getClient($id);
        $_POST["sender-iban"] = $client["compte"]->getNumeroCompte();
        $this->virement("virement-client");
    }


    private function virement($redirect)
    {
        $request = new VirementRequest($_POST);
        if (!$request->validate()) {
            Session::set('errorVirement', $request->getErrors());
            Session::set('dataVirement', $_POST);
            $this->redirect("$redirect");
            exit;
        }
        Session::unset('errorVirement');
        Session::unset('dataVirement');
        if (!$this->transactionService->virement($_POST)) {
            Session::set('error', "Une erreur s'est produite lors de virement l'argent.");
            $this->redirect("$redirect");
            exit;
        }
        $idhistorique = $this->historiqueService->saveHistoriqueVirement($_POST);
        Session::set("post", $_POST);
        $this->redirect("recu/$redirect");
        exit;
    }


}