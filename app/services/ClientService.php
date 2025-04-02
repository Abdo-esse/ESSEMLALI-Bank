<?php

namespace App\services;

use App\Repository\ClientRepository;

class ClientService {
    private ClientRepository $clientRepo;

    public function __construct() {
        $this->clientRepo = new ClientRepository();

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
       return $this->clientRepo->create($dataUser,$dataClient);
        
    }
    public function update($id, $data){
       return $this->clientRepo->update('users', $id, $data);
    }

    public function getAll(){
        return $this->clientRepo->readAll('roles');
    }
    public function find($id){
        return $this->clientRepo->find('roles', $id);
    }
    
}
