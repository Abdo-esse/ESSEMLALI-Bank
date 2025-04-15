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

        if (isset($data['accountNumberBeneficiaire'])&&!empty($data['accountNumberBeneficiaire'])) {
            $historique["id_beneficiaire"] = $this->getIdAcount($data['accountNumberBeneficiaire']);
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
}
