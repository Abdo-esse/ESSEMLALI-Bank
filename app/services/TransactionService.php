<?php 
namespace App\Services;

use App\Repositories\CompteRepository;
use Exception;

class TransactionService
{
    private CompteRepository $compteRepo;

    public function __construct()
    {
        $this->compteRepo = new CompteRepository();
    }

    public function updateBalance( $accountNumber,  $amount)
    {
        $account = $this->compteRepo->findAcount($accountNumber);

        $currentBalance = $account->getSolde();
        $newBalance = $currentBalance + $amount;

        return $this->compteRepo->update('comptes', $account->getId(), [
            "solde" => $newBalance
        ]);
    }
}
