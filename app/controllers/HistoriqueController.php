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
        $historiques=$this->historiqueService->getHistorique(22);
        // foreach ($historiques as $historique) {
        //     echo "<pre>";
        //     var_dump($historique->donneur); // ou print_r($historique);
        //     echo "</pre>";
        // }
         echo  $this->twig->render('client/historique.twig',['historiques' => $historiques,'session' => $_SESSION, 'userId' => 22]);
    }
}