<?php

namespace App\Controllers;
require dirname(__DIR__) . '/../vendor/autoload.php'; 

use Dompdf\Dompdf;

class ReçuController extends Controller{

    public function recuVirement(){
        echo  $this->twig->render('reçu/virement.twig',['session' => $_SESSION ]);
    }
}