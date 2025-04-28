<?php

namespace App\Controllers;

use App\services\CompteService;
use App\core\Session;

class CompteController extends Controller
{
    private CompteService $comptService;

    public function __construct()
    {
        parent::__construct();
        $this->comptService = new CompteService;
    }

    public function approuver($id)
    {
        if ($this->comptService->approuver($id)) {
            $this->redirect('demande-compte');
            exit;
        }

    }

    public function refuser($id)
    {
        if ($this->comptService->refuser($id)) {
            $this->redirect('demande-compte');
            exit;
        }

    }


}