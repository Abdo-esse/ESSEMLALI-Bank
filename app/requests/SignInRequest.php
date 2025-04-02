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
        
        if (empty($this->data['conditions']) || $this->data['conditions'] !== "on") {
            $this->errors['conditions'] = 'Vous devez accepter les conditions.';
        }
        if (!isset($_FILES['carte_identite']) || $_FILES['carte_identite']['error'] !== UPLOAD_ERR_OK) {
            $this->errors['carte_identite'] = 'Le fichier de la carte d\'identité est requis.';
        } else {
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $fileName = $_FILES['carte_identite']['name'];
            $fileTmp  = $_FILES['carte_identite']['tmp_name'];
            $fileSize = $_FILES['carte_identite']['size'];
            $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $mimeType = mime_content_type($fileTmp);
        
            // Liste des types MIME acceptés
            $allowedMimeTypes = ['image/png', 'image/jpeg'];
        
            if (!in_array($fileExt, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
                $this->errors['carte_identite'] = 'Le fichier doit être une image PNG, JPG ou JPEG.';
            } elseif ($fileSize > 2 * 1024 * 1024) { // 2MB max
                $this->errors['carte_identite'] = 'Le fichier ne doit pas dépasser 2MB.';
            }
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
