<?php 
namespace App\Services;

use App\Repository\CompteRepository;
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
    public function virement($data)
    {
        $accountSender = $this->compteRepo->findAcount($data["sender-iban"]);
        $accountRecipient = $this->compteRepo->findAcount($data["recipient-iban"]);
        $newBalanceSender=$accountSender->getSolde() - $data["amount"];
        $newBalanceRecipient=$accountRecipient->getSolde() + $data["amount"];
        $dataSendre=[
            "id"=>$accountSender->getId(),
            "solde"=>$newBalanceSender
        ];
        $dataRecipient=[
            "id"=>$accountRecipient->getId(),
            "solde"=>$newBalanceRecipient
        ];
         echo "<pre>";
        var_dump($dataRecipient,$dataSendre);
        echo "<pre>";
        // $currentBalance = $account->getSolde();
        // $newBalance = $currentBalance + $amount;

        // return $this->compteRepo->update('comptes', $account->getId(), [
        //     "solde" => $newBalance
        // ]);
    }

}
