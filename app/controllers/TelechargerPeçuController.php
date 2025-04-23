<?php

namespace App\Controllers;
require dirname(__DIR__) . '/../vendor/autoload.php'; 

use Dompdf\Dompdf;
use App\core\Session;

class TelechargerPeçuController extends Controller{
    
    public function telechargerRecuVirement(){
     $this->telechargerRecu("recu_virement");
    }
    public function telechargerRecuVersement(){
     $this->telechargerRecu("recu_versement");
    }
    public function telechargerRecuRetrait(){
     $this->telechargerRecu("recu_retrait");
    }
    public function telechargerVirementClient(){
     $this->telechargerRecu("recu-virement");
    }


    private function telechargerRecu($recu){
        $data = $_SESSION['data'] ?? null;
        if (!$data) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }    
        $html = $this->twig->render("reçu/$recu.twig", ['session' => $_SESSION]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("$recu.pdf", ["Attachment" => true]);
    }

    
}