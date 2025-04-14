<?php

namespace App\services;


class HistoriqueService {

    private HistoriqueRepository $historiqueRepo;

    public function __construct() {
        $this->historiqueRepo = new HistoriqueRepository();
    }

    public function saveHistorique($id_donneur,$type_operation,$montant,$id_beneficiaire = null,$description = null) {

        $data = [
            "id_donneur" => $id_donneur,
            "type_operation" => $type_operation,
            "montant" => $montant,
        ];

        if ($id_beneficiaire !== null) {
            $data["id_beneficiaire"] = $id_beneficiaire;
        }

        if ($description !== null) {
            $data["description"] = $description;
        }

        $this->historiqueRepo->save($data);
    }
}
