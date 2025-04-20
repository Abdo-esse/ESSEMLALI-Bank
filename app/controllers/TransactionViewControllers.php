<?php 
namespace App\Controllers;

use App\core\Session;

class TransactionViewControllers extends Controller
{
    
    public function versement()
    {
        Session::unset('data');  
        Session::unset('post');
       echo  $this->twig->render('employe/versement.twig',['session' => $_SESSION ]);
    }
    public function retrait()
    {
        Session::unset('data');  
        Session::unset('post');
       echo  $this->twig->render('employe/retrait.twig',['session' => $_SESSION ]);
    }
    public function virement()
    {
        Session::unset('data');  
        Session::unset('post');    
       echo  $this->twig->render('employe/virement.twig',['session' => $_SESSION ]);
    }
    public function virementClient()
    {   
       echo  $this->twig->render('client/virement.twig',['session' => $_SESSION ]);
    }
    


}