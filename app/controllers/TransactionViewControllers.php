<?php 
namespace App\Controllers;

use App\core\Session;

class TransactionViewControllers extends Controller
{
    public function __construct(){
        parent::__construct();
        Session::unset('data');  
        Session::unset('post');

    }
    
    public function versement()
    {        
       echo  $this->twig->render('employe/versement.twig',['session' => $_SESSION ]);
    }
    public function retrait()
    {        
       echo  $this->twig->render('employe/retrait.twig',['session' => $_SESSION ]);
    }
    public function virement()
    {     
       echo  $this->twig->render('employe/virement.twig',['session' => $_SESSION ]);
    }
    public function virementClient()
    {   
       echo  $this->twig->render('client/virement.twig',['session' => $_SESSION ]);
    }
    


}