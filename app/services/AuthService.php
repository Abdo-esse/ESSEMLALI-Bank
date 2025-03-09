<?php

namespace App\services;

 use App\Repository\UserRepository;

class AuthService {
    private UserRepository $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function login( $email, $password) {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            return "Utilisateur introuvable !";
        }

        if (!password_verify($password, $user['mot_de_passe'])) {
            return "Mot de passe incorrect !".$user['mot_de_passe'];
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        return "Connexion réussie en tant que " . $user['role'];
    }

    public function add($data){
        $this->userRepo->createAction("users", $data);
    }
}
