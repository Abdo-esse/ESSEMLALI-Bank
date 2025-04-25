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
        $dataClient=[
            "telephone"=>$_POST["telephone"],
            "address"=>$_POST["address"]
        ];
        
        $dataUser=[
            "email"=>$_POST["email"],
            "date_modification" => date('Y-m-d H:i:s') 
        ];
        if (!empty($_POST["passwordNew"])) {
            $dataUser['mot_de_passe'] = password_hash($_POST["passwordNew"], PASSWORD_DEFAULT);
        }
       return $this->clientRepo->edit( $id, $dataUser, $dataClient);
    }

    public function getAll(){
        return $this->clientRepo->readAll('roles');
    }
    public function find($id){
        return $this->clientRepo->find('roles', $id);
    }
    public function allClients(){
        return $this->clientRepo->allClient();
    }
    public function getClient($id){
        return $this->clientRepo->getClient($id);
    }
    
    public function findclient($id){
        return $this->clientRepo->findclient($id);
    }
    public function searchClient($keyword){
        return $this->clientRepo->searchClient($keyword);
    }
    
}
