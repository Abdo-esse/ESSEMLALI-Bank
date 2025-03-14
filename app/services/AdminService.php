<?php

namespace App\services;

 use App\Repository\UserRepository;
 use App\core\Session;

class AdminService {
    private UserRepository $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
        Session::start();

    }

    public function addAdmin($date){

    }

    
}
