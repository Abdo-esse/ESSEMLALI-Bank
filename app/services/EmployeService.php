<?php

namespace App\services;

 use App\Repository\EmployRepository;

class EmployeService {
    private EmployRepository $employRepo;

    public function __construct() {
        $this->employRepo = new EmployRepository();

    }

    public function Addemploye($date){
       return $this->employRepo->addEmploy($date);
    }

    public function getAllEmployes(){
        return $this->employRepo->readAll('roles');
    }

    
}
