<?php

namespace App\services;

use App\Repository\ClientRepository;

class ClientService {
    private ClientRepository $employRepo;

    public function __construct() {
        // $this->employRepo = new ClientRepository();

    }

    public function create(){
        
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
