<?php

namespace App\services;

use App\Repository\ClientRepository;

class ClientService {
    private ClientRepository $employRepo;

    public function __construct() {
        $this->employRepo = new ClientRepository();

    }

    public function create(){
        $dataClient=[
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
        
    }
    public function update($id, $data){
       return $this->employRepo->update('users', $id, $data);
    }

    public function getAll(){
        return $this->employRepo->readAll('roles');
    }
    public function find($id){
        return $this->employRepo->find('roles', $id);
    }

    
}
