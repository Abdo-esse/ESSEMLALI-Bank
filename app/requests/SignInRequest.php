<?php

namespace App\requests;

class SignInRequest {
    private $data;
    private $errors = [];
    
    public function __construct(array $data) {
        $this->data = $data;
    }
    
    public function validate(): bool {
        if (empty($this->data['nom'])) {
            $this->errors['nom'] = 'Le nom est requis';
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ ]{3,20}$/", $this->data['nom'])) {
            $this->errors['nom'] = 'Format du nom invalide';
        }
        if (empty($this->data['prenom'])) {
            $this->errors['prenom'] = 'Le prénom est requis';
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ ]{3,20}$/", $this->data['prenom'])) {
            $this->errors['prenom'] = 'Format du prénom invalide';
        }

        if (empty($this->data['email'])) {
            $this->errors['email'] = 'L\'email est requis';
        } elseif (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Format de l\'email invalide';
        }

        if (empty($this->data['sexe'])) {
            $this->errors['sexe'] = 'Le sexe est requis';
        } elseif (!in_array(strtolower($this->data['sexe']), ['femme', 'homme'])) {
            $this->errors['sexe'] = 'Le sexe doit être "femme" ou "homme"';
        }

        if (empty($this->data['telephone'])) {
            $this->errors['telephone'] = 'Le téléphone est requis';
        } elseif (!preg_match("/^\+?\d{10,}$/", $this->data['telephone'])) {
            $this->errors['telephone'] = 'Format du téléphone invalide';
        }
        
        if (empty($this->data['adresse'])) {
            $this->errors['adresse'] = 'L\'adresse est requise';
        } elseif (!preg_match("/^[a-zA-Z0-9\s,.'-]{5,}$/", $this->data['adresse'])) {
            $this->errors['adresse'] = 'Format de l\'adresse invalide';
        }

        return empty($this->errors);
    }
    
    public function getErrors(): array {
        return $this->errors;
    }
    
    public function getData(): array {
        return $this->data;
    }
}
