<?php

namespace App\Controllers;
require dirname(__DIR__) . '/../vendor/autoload.php'; 

use App\services\ReçuService;
use Dompdf\Dompdf;
use App\core\Session;

class ReçuController extends Controller{

    private ReçuService $reçuService;
    public function __construct(){
        parent::__construct();
        $this->reçuService=new ReçuService();

    }

    public function recuVirement(){
        $data=Session::get("post");
        $data=$this->reçuService->dataReçuVirement($data);
        echo  $this->twig->render('reçu/virement.twig',['session' => $_SESSION,'data'=>$data ]);
        exit;
    }

    
}