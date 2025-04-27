<?php

namespace App\services;

use App\Repository\AdminRepository;

class AdminService
{
    private AdminRepository $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();

    }

    public function create($data)
    {
        $dataCreat = [
            "nom" => trim($data["nom"]),
            "prenom" => trim($data["prenom"]),
            "email" => trim($data["email"]),
            "mot_de_passe" => password_hash($data["mot_de_passe"], PASSWORD_DEFAULT),
            "is_active" => true
        ];
        return $this->adminRepo->create($dataCreat);
    }

    public function getAll()
    {
        return $this->adminRepo->readAll('roles');
    }


}
