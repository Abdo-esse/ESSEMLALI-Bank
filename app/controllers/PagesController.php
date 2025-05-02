<?php

namespace App\Controllers;

use App\core\Session;

class PagesController extends Controller
{

    public function index()
    {
        $flash = Session::getFlash("signIn");
        echo $this->twig->render('pages/home.twig', ['flash_signIn' => $flash]);

    }

    public function apropos()
    {
        echo $this->twig->render('pages/apropos.twig');

    }

    public function prets()
    {
        echo $this->twig->render('pages/prets.twig');

    }
    public function notFound()
    {
        echo $this->twig->render('pages/404.twig');

    }
}