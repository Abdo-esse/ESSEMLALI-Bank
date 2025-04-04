<?php

namespace App\requests;

class UpdateClientRequest {
    private $data;
    private $errors = [];
    
    public function __construct(array $data) {
        $this->data = $data;
    }
    
    public function validate(): bool {
        
        

        if (empty($this->data['email'])) {
            $this->errors['email'] = 'L\'email est requis';
        } elseif (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Format de l\'email invalide';
        }
        if (empty($this->data['passwordActuel'])) {
            $this->errors['passwordActuel'] = 'L\'email est requis';
        } elseif (!password_verify($data['passwordActuel'], $_SESSION['password'])) {
            $this->errors['passwordActuel'] = 'password incorect , '.$_SESSION['password'];
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
