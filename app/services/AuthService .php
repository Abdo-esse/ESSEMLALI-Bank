<?php
namespace App\services;

 use App\Repository\UserRepository;

class AuthService {
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function login(string $email, string $password) {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            return "Utilisateur introuvable !";
        }

        if (!password_verify($password, $user['mot_de_passe'])) {
            return "Mot de passe incorrect !";
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        return "Connexion réussie en tant que " . $user['role'];
    }
}
