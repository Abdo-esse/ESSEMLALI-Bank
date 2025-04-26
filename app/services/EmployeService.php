<?php

namespace App\services;

 use App\Repository\EmployRepository;

class EmployeService {
    private EmployRepository $employRepo;

    public function __construct() {
        $this->employRepo = new EmployRepository();

    }

    public function create($date){
       return $this->employRepo->create($date);
    }
    public function update($id, $data){
       return $this->employRepo->update('users', $id, $data);
    }

    public function getAll(){
        return $this->employRepo->readAll('roles');
    }
    public function searchEmployes($keyword){
        return $this->employRepo->searchEmployes($keyword);
    }
    public function find($id){
        return $this->employRepo->find('roles', $id);
    }

    
}
