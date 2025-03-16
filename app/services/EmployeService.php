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

    public function getAll(){
        return $this->employRepo->readAll('roles');
    }

    
}
