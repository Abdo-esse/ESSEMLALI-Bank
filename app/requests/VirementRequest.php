<?php

namespace App\requests;

use App\services\CompteService;

class VirementRequest
{
    private $data;
    private $errors = [];
    private CompteService $comptService;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->comptService = new CompteService;
    }

    public function validate(): bool
    {

        $this->validateIban('sender-iban', 'Sender');
        $this->validateIban('recipient-iban', 'Recipient');
        if (empty($this->data['amount'])) {
            $this->errors['amount'] = 'Amount is required.';
        } elseif (!is_numeric($this->data['amount']) || $this->data['amount'] < 10) {
            $this->errors['amount'] = 'Amount must be at least 10.';
        } elseif ($this->data['amount'] > 10000) {
            $this->errors['amount'] = 'Amount exceeds the maximum limit.';
        } elseif (empty($this->errors['sender-iban'])) {
            $sender = $this->comptService->find($this->data["sender-iban"]);
            if ($sender && $sender->getSolde() < $this->data['amount']) {
                $this->errors['amount'] = 'Insufficient funds in sender\'s account.';
            }
        }

        if (empty($this->data['description'])) {
            $this->errors['description'] = 'description is required.';
        }


        return empty($this->errors);
    }

    private function validateIban(string $key, string $label): void
    {
        if (empty($this->data[$key])) {
            $this->errors[$key] = "$label IBAN is required.";
        } elseif (!$this->comptService->find($this->data[$key])) {
            $this->errors[$label] = "$label IBAN is invalid.";
        }
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