<?php

namespace App\Controllers;
use App\core\Session;

class Controller
{
    protected $twig;

    public function __construct()
    {
          $this->twig= require dirname( __DIR__) .'/config/Twig.php';
          Session::start();
    }

    protected function redirect($url)
    {
        header("Location: /ESSEMLALI-Bank/$url");
        exit;
    }
}