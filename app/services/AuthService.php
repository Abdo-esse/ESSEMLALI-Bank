<?php

namespace App\services;

use App\Repository\UserRepository;
use App\core\Session;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        Session::start();

    }

    public function login($email, $password)
    {
        $user = $this->userRepo->findByEmail('users', $email);

        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            Session::getFlash('valueslogin', $_POST);
            Session::getFlash('login', "Email ou mot de passe incorrect.");
            return false;
        }
        if ($user['mot_de_passe'] === false) {
            Session::getFlash('login', "You account is desactive .");
            Session::getFlash('valueslogin', $_POST);

            return false;
        }

        Session::set('user', [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role']
        ]);
        return true;
    }

    public function add($data)
    {
        $this->userRepo->createAction("users", $data);
    }


}
