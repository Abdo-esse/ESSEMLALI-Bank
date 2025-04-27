<?php

namespace App\Controllers;
require dirname(__DIR__) . '/../vendor/autoload.php';

use App\services\ReçuService;
use Dompdf\Dompdf;
use App\core\Session;

class ReçuController extends Controller
{

    private ReçuService $reçuService;

    public function __construct()
    {
        parent::__construct();
        $this->reçuService = new ReçuService();

    }

    public function recuVirement()
    {
        if (!Session::get("post")) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
        $data = Session::get("post");
        $data = $this->reçuService->dataReçuVirement($data);
        Session::set('data', $data);
        echo $this->twig->render('reçu/virement.twig', ['session' => $_SESSION]);
        exit;
    }

    public function recuVirementClient()
    {
        if (!Session::get("post")) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
        $data = Session::get("post");
        $data = $this->reçuService->dataReçuVirement($data);
        Session::set('data', $data);
        echo $this->twig->render('reçu/virement_client.twig', ['session' => $_SESSION]);
        exit;
    }

    public function recuVersement()
    {
        if (!Session::get("post")) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
        $data = Session::get("post");
        $data = $this->reçuService->dataReçu($data);
        Session::set('data', $data);
        echo $this->twig->render('reçu/versement.twig', ['session' => $_SESSION]);
        exit;
    }

    public function recuRetrait()
    {
        if (!Session::get("post")) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
        $data = Session::get("post");
        $data = $this->reçuService->dataReçu($data);
        Session::set('data', $data);
        echo $this->twig->render('reçu/retrait.twig', ['session' => $_SESSION]);
        exit;
    }
}