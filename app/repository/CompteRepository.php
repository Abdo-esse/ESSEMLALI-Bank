<?php
namespace App\Repository;

use App\Models\Compte;
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
    
    public function findAcount($numeroCompte){
        $compte=$this->find($this->table, ["numeroCompte"=>$numeroCompte]);
        if($compte){
            return new Compte(
            $compte->numerocompte,
            $compte->solde,
            $compte->datecreation,
            $compte->estactif
        );

        }
        return false;
    }

   


    
    
}