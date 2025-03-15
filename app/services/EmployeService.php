<?php

namespace App\services;

 use App\Repository\EmployRepository;

class EmployeService {
    private Employepository $userRepo;

    public function __construct() {
        $this->employRepo = new EmployRepository();

    }

    public function employes($date){
       return $this->employepo->addAdmin($date);
    }

    public function getAllAdmins(){
        return $this->employepo->readAll('roles');
    }

    
}
