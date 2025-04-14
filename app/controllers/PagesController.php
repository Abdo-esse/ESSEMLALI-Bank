<?php 
namespace App\Controllers;


class PagesController extends Controller
{
    public function index()
    {
       echo  $this->twig->render('pages/home.twig');

    }
    public function apropos()
    {
       echo  $this->twig->render('pages/apropos.twig');

    }
    public function prets()
    {
       echo  $this->twig->render('pages/prets.twig');

    }
}