<?php

namespace App\requests;
use App\Repository\UserRepository;
class StoreUserRequest
{
    private $data;
    private $errors = [];
    private UserRepository $userRepo;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->userRepo = new UserRepository();
    }

    public function validate(): bool
    {

        if (empty($this->data['nom'])) {
            $this->errors['nom'] = 'nom is required';
        } elseif (!preg_match("/[a-zA-Z ]{3,20}$/", $this->data['nom'])) {
            $this->errors['nom'] = 'Invalid nom format';
        }

        if (empty($this->data['prenom'])) {
            $this->errors['prenom'] = 'prenom is required';
        } elseif (!preg_match("/[a-zA-Z ]{3,20}$/", $this->data['prenom'])) {
            $this->errors['prenom'] = 'Invalid prenom format';
        }

        if (empty($this->data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }elseif ($this->userRepo->findByEmail('users', $this->data['email'])) {
            $this->errors['email'] = 'Impossible d\'utiliser cette adresse e-mail';
        }

        if (empty($this->data['mot_de_passe'])) {
            $this->errors['mot_de_passe'] = 'Password is required';
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getData(): array
    {
        return $this->data;
    }
}