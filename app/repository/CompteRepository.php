<?php
namespace App\Repository;
use PDO;
class CompteRepository  extends BaseRepository
{

    private $table;
    public function __construct() {
        parent::__construct(); 
        $this->table="comptes";
    }

    public function create($data){
       return $this->createAction($this->table, $data);
    }

   


    
    
}