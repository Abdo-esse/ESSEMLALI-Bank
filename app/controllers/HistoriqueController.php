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
}