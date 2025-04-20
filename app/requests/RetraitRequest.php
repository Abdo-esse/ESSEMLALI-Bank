<?php

namespace App\requests;
use App\services\CompteService;
class RetraitRequest {
    private $data;
    private $errors = [];
    private CompteService $comptService;
    public function __construct(array $data) {
        $this->data = $data;
        $this->comptService= new CompteService;
    }
    
    public function validate(): bool {
        $comte=$this->comptService->find($this->data["account_number"]);
        if (empty($this->data['account_number'])) {
            $this->errors['account_number'] = 'account number is required';
        } elseif (!$comte) {
            $this->errors['account_number'] = 'Invalid account number ';
        }
           
        if (empty($this->data['amount'])) {
            $this->errors['amount'] = 'amount is required';
        }elseif (!is_numeric($this->data['amount']) || $this->data['amount'] < 10) {
            $this->errors['amount'] = 'Amount must be a positive number and superieur a 10';
        } elseif ($this->data['amount'] > 100000) {
            $this->errors['amount'] = 'Amount exceeds the allowed limit';
        }elseif($comte && $comte->getSolde()<$this->data['amount']){
            $this->errors['amount'] = 'Votre solde insufusant';
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