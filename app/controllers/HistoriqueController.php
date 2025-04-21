<?php

namespace App\Controllers;

use App\services\HistoriqueService;
use App\core\Session;


class HistoriqueController extends Controller {

    private HistoriqueService $historiqueService;

    public function __construct(){
        parent::__construct();
        $this->historiqueService= new HistoriqueService();
    }

    public function historique(){
        $id= $_SESSION["user"]["id"];
        $historiques=$this->historiqueService->getHistorique($id);
         echo  $this->twig->render('client/historique.twig',['historiques' => $historiques,'session' => $_SESSION]);
    }
}