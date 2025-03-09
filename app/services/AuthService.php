<?php

namespace App\services;

 use App\Repository\UserRepository;
 use App\core\Session;

class AuthService {
    private UserRepository $userRepo;
    private $errors = [];

    public function __construct() {
        $this->userRepo = new UserRepository();
        Session::start();

    }

    public function login( $email, $password) {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->errors['login'] = "Email ou mot de passe incorrect.";
            return false;
        }

            Session::set('user', [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ]);
         return true;
    }

    public function add($data){
        $this->userRepo->createAction("users", $data);
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
