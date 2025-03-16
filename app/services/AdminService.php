<?php

namespace App\services;

 use App\Repository\AdminRepository;

class AdminService {
    private AdminRepository $userRepo;

    public function __construct() {
        $this->adminRepo = new AdminRepository();

    }

    public function create($date){
       return $this->adminRepo->create($date);
    }

    public function getAll(){
        return $this->adminRepo->readAll('roles');
    }

    
}
