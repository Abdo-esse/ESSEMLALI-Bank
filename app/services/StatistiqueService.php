<?php

namespace App\services;

 use App\Repository\StatistiqueAdminRepository;
 use App\Repository\StatistiqueEmployRepository;

class StatistiqueService {
    private StatistiqueAdminRepository $statistiqueAdminRepo;
    private StatistiqueEmployRepository $StatistiqueEmployRepo;

    public function __construct() {
        $this->statistiqueAdminRepo = new StatistiqueAdminRepository();
        $this->StatistiqueEmployRepo = new StatistiqueEmployRepository();
    }

    public function statistiqueAdmin(){
        $data=[];
        $data["totalClients"]=$this->statistiqueAdminRepo->nbrClient();
        $data["nbrClientParMois"]=$this->statistiqueAdminRepo->nbrClientParMois();
        $data["nbrEmployer"]=$this->statistiqueAdminRepo->nbrEmployer();
        $data["nbrEmployerParMois"]=$this->statistiqueAdminRepo->nbrEmployerParMois();
        $data["nbrHistorique"]=$this->statistiqueAdminRepo->nbrHistorique();
        $data["totalSolde"]=$this->statistiqueAdminRepo->totalSolde();
        return $data;
    }
    public function statistiqueEmploye(){
        $data=[];
        $data["nbrCompte"]=$this->StatistiqueEmployRepo->nbrCompte();
        $data["nbrCompteParMois"]=$this->StatistiqueEmployRepo->nbrCompteParMois();
        $data["nbrDemandes"]=$this->StatistiqueEmployRepo->nbrDemandes();
        $data["nbrDemandesParMois"]=$this->StatistiqueEmployRepo->nbrDemandesParMois();
        $data["nbrHistorique"]=$this->StatistiqueEmployRepo->nbrHistorique();
        $data["totalSolde"]=$this->StatistiqueEmployRepo->totalSolde();
        return $data;
    }


    
}
