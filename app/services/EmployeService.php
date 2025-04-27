<?php

namespace App\services;

use App\Repository\EmployRepository;

class EmployeService
{
    private EmployRepository $employRepo;

    public function __construct()
    {
        $this->employRepo = new EmployRepository();

    }

    public function create($data)
    {
        $dataCreate = [
            "nom" => trim($data["nom"]),
            "prenom" => trim($data["prenom"]),
            "email" => trim($data["email"]),
            "mot_de_passe" => password_hash($data["mot_de_passe"], PASSWORD_DEFAULT),
            "is_active" => true
        ];
        return $this->employRepo->create($dataCreate);
    }

    public function update($id, $data)
    {
        $dataUpdate = [
            "nom" => trim($data["nom"]),
            "prenom" => trim($data["prenom"]),
            "email" => trim($data["email"]),
            "mot_de_passe" => password_hash($data["mot_de_passe"], PASSWORD_DEFAULT),
            "date_modification" => date('Y-m-d H:i:s')
        ];
        return $this->employRepo->update('users', $id, $dataUpdate);
    }

    public function activerDesactiver($id, $data){
        return $this->employRepo->update('users', $id, $data);
    }

    public function getAll()
    {
        return $this->employRepo->readAll('roles');
    }

    public function searchEmployes($keyword)
    {
        return $this->employRepo->searchEmployes($keyword);
    }

    public function find($id)
    {
        return $this->employRepo->find('roles', $id);
    }


}
