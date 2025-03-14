<?php

namespace App\services;

 use App\Repository\AdminRepository;

class AdminService {
    private AdminRepository $userRepo;

    public function __construct() {
        $this->adminRepo = new AdminRepository();

    }

    public function addAdmin($date){
       return $this->adminRepo->addAdmin($date);
    }

    
}
