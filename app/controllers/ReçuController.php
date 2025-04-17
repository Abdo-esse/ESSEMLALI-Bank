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
        echo  $this->twig->render('reçu/virement.twig',['session' => $_SESSION ]);
        exit;
    }
    public function telechargerRecuVirement(){
        $data = $_SESSION['data'] ?? null;
        
        if (!$data) {
            // Rediriger ou afficher une erreur
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
    
        $html = $this->twig->render('reçu/recu_virement.twig', ['session' => $_SESSION]);
    
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('recu_virement.pdf', ["Attachment" => true]);
        echo"3la molana";
        exit;
    }

    
}