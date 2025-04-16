<?php 
namespace App\Services;
use App\services\CompteService;
use App\Repository\ClientRepository;
use Exception;

class ReçuService
{
    private CompteService $comptService;
    private ClientRepository $clientRepo;
    public function __construct()
    {
        $this->comptService= new CompteService();
        $this->clientRepo= new ClientRepository();

    }

    public function getAcount($accountNumber){
        return $this->comptService->find($accountNumber);
    }
    public function getClient($id){
        return $this->clientRepo->findById($id);
    }

    

  
}
