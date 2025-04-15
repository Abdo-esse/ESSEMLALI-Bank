<?php

namespace App\services;
use App\Repository\HistoriqueRepository;
use App\services\CompteService;

class HistoriqueService {

    private HistoriqueRepository $historiqueRepo;

    private CompteService $comptService;

    public function __construct() {
        $this->historiqueRepo = new HistoriqueRepository();
        $this->comptService= new CompteService;

    }

    public function saveHistorique($data,$typeOperation) {

        $historique = [
            "id_donneur" => $this->getIdAcount($data['account_number']),
            "type_operation" => $typeOperation,
            "montant" => $data['amount'],
        ];

        if (isset($data['numberBeneficiaire'])&&!empty($data['numberBeneficiaire'])) {
            $historique["id_beneficiaire"] = $this->getIdAcount($data['numberBeneficiaire']);
        }    
        if (!empty($data['description'])) {
            $historique["description"] = $data['description'];
        }
        return $this->historiqueRepo->save($historique);
    }

    private function getIdAcount($accountNumber){
        $acounte=$this->comptService->find($accountNumber);
        return $acounte->getId();
    }

    public function saveHistoriqueVirement($data){
        $virmentData=[
            "account_number"=> $data["sender-iban"],
            "numberBeneficiaire"=> $data["recipient-iban"],
            "amount"=> $data["amount"],
            "description"=>$data["description"]
        ];
        return $this->saveHistorique($virmentData,"virement");
    }
}

