<?php

namespace App\Controllers;
require dirname(__DIR__) . '/../vendor/autoload.php';

use App\services\ReçuService;
use Dompdf\Dompdf;
use App\requests\SignInRequest;
use App\requests\UpdateClientRequest;
use App\services\ClientService;
use App\services\CompteService;
use App\core\Session;

class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct()
    {
        parent::__construct();
        $this->clientService = new ClientService();
    }

    public function allClients()
    {
        $clients = $this->clientService->allClients();
        echo json_encode($clients);
    }

    public function allDemandeClients()
    {
        $demandeClients = $this->clientService->getAll();
        echo json_encode($demandeClients);
    }


    public function update($id)
    {
        $client = $this->clientService->findclient($id);
        $_POST["motDePassEnregister"] = $client['mot_de_passe'];
        $request = new UpdateClientRequest($_POST);
        if (!$request->validate()) {
            Session::setFlash('errorEditClient', $request->getErrors());
            $this->redirect("update-info");
            exit;
        }
        if (!$this->clientService->update($id, $_POST)) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de l'employer.");
            $this->redirect('Client');
            exit;
        }

        $this->redirect('Client');
        exit;
    }

    private function addClients($where)
    {
        $request = new SignInRequest($_POST);
        if (!$request->validate()) {
            Session::setFlash('errorClient', $request->getErrors());
            Session::setFlash('valuesClient', $_POST);
            $this->redirect("$where");
            exit;
        }
        $fileName = uniqid() . '_' . $_FILES['carte_identite']['name'];
        $uploadPath = __DIR__ . '/../../public/uploads/' . $fileName;

        if (move_uploaded_file($_FILES['carte_identite']['tmp_name'], $uploadPath)) {
            $_POST['carte_identite'] = $fileName;
        }

        $clientId = $this->clientService->create();
        if (!$clientId) {
            Session::set('error', "Une erreur s'est produite lors de l'ajout de client.");
            $this->redirect("$where");
        }
        return $clientId;
    }

    public function store()
    {
        $this->addClients("sign-in");
        Session::setFlash("signIn", "Votre demande de création de compte a bien été reçue.");
        header('Location: /ESSEMLALI-Bank');
        exit;
    }

    public function add()
    {
        $clientId = $this->addClients("demande-compte");
        if ($clientId) {
            $compteService = new CompteService();
            if ($compteService->approuver($clientId)) {
                $this->redirect('demande-compte');
                exit;
            }

        }
    }

    public function delete($id)
    {
        if (!$this->clientService->delete($id)) {
            Session::set('error', "Une erreur s'est produite lors de la supression de client.");
            $this->redirect('client/' . $id);
            exit;
        }
        $this->redirect('clients');
        exit;
    }


    public function telechargeRib()
    {
        $id = $_SESSION["user"]["id"];
        $data = $this->clientService->getClient($id);
        if (!$data) {
            echo "Aucune donnée pour générer le reçu.";
            exit;
        }
        $html = $this->twig->render("reçu/releve_compte.twig", ['session' => $_SESSION, 'client' => $data]);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("releve_compte.pdf", ["Attachment" => true]);
    }

    public function searchClient()
    {
        if (isset($_GET["keyword"])) {
            $keyword = $_GET["keyword"];
        }
        $data = $this->clientService->searchClient($keyword);
        echo(json_encode($data));

    }

    public function searchDemandeClient()
    {
        if (isset($_GET["keyword"])) {
            $keyword = $_GET["keyword"];
        }
        $data = $this->clientService->searchDemandeClient($keyword);
        echo(json_encode($data));

    }


}