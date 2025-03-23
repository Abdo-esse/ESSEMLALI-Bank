<?php

namespace App\services;

use App\Repository\CompteRepository;

class CompteService {
    private CompteRepository $compteRepo;

    public function __construct() {
        $this->compteRepo = new CompteRepository();

    }

    public function create(){
        $dataCompte=[
            "sexe"=>$_POST["sexe"],
            "telephone"=>$_POST["telephone"],
            "carte_national"=>$_POST["carte_identite"],
            "address"=>$_POST["adresse"]
        ];
        $dataUser=[
            "nom"=>$_POST["nom"],
            "prenom"=>$_POST["prenom"],
            "email"=>$_POST["email"],
            "is_active"=>"false"
        ];
       return $this->compteRepo->create($dataUser,$dataCompte);
        
    }
    public function approuver($id){
       return $this->compteRepo->update('users', $id, $data);
    }

    public function getAll(){
        return $this->compteRepo->readAll('roles');
    }
    public function find($id){
        return $this->compteRepo->find('roles', $id);
    }

    
}
