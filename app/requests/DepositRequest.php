<?php

namespace App\requests;
use App\services\CompteService;
class DepositRequest {
    private $data;
    private $errors = [];
    private CompteService $comptService;
    public function __construct(array $data) {
        $this->data = $data;
        $this->comptService= new CompteService;
    }
    
    public function validate(): bool {
        if (empty($this->data['account_number'])) {
            $this->errors['account_number'] = 'account number is required';
        } elseif (!$this->comptService->find($_POST["account_number"])) {
            $this->errors['email'] = 'Invalid email format';
        }
        
        if (empty($this->data['password'])) {
            $this->errors['password'] = 'Password is required';
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