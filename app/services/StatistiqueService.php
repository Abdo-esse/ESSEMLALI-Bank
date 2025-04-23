<?php

namespace App\services;

 use App\Repository\StatistiqueAdminRepository;

class StatistiqueService {
    private StatistiqueAdminRepository $statistiqueAdminRepo;

    public function __construct() {
        $this->statistiqueAdminRepo = new StatistiqueAdminRepository();

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


    
}
