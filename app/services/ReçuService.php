<?php 
namespace App\Services;

use App\Repository\ReçuRepository;
use Exception;

class ReçuService
{
    private ReçuRepository $reçuRepo;

    public function __construct()
    {
        $this->reçuRepo = new ReçuRepository();
    }

  
}
