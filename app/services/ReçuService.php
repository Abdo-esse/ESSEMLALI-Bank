<?php 
namespace App\Services;
use App\services\CompteService;
use App\Repository\ClientRepository;
use App\core\Session;
use Exception;

class ReçuService
{
    private CompteService $comptService;
    private ClientRepository $clientRepo;
    public function __construct()
    {
        $this->comptService= new CompteService();
        $this->clientRepo= new ClientRepository();
        Session::start();
    }

    public function dataReçuVirement($data){
        $acountSender=$this->getAcount($data["sender-iban"]);
        $acountRicipient=$this->getAcount($data["recipient-iban"]);
        $clientSender=$this->getClient($acountSender->getClientId());
        $clientRicipient=$this->getClient($acountRicipient->getClientId());
        return [
            'acountRicipient' => $acountRicipient,'clientSender' => $clientSender,
            'acountSender' => $acountSender,'clientRicipient' => $clientRicipient
        ];
    }
    public function dataReçuVersement($data){
        $acount=$this->getAcount($data["account_number"]);
        $client=$this->getClient($acount->getClientId());
        return [
            'acount' => $acount,'client' => $client,
        ];
    }

    public function getAcount($accountNumber){
        return $this->comptService->find($accountNumber);
    }
    public function getClient($id){
        return $this->clientRepo->findById($id);
    }

    

  
}
