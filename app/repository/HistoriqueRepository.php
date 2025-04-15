<?php
namespace App\Repository;

use App\Models\Compte;
use PDO;
class HistoriqueRepository  extends BaseRepository
{

    private $table;
    public function __construct() {
        parent::__construct(); 
        $this->table="historique";
    }

    public function save($data){
       return $this->createAction($this->table, $data);
    }
    
    public function findAcount($numeroCompte){
        $compte=$this->find($this->table, ["numeroCompte"=>$numeroCompte]);
        if($compte){
            return new Compte(
            $compte->numerocompte,
            $compte->solde,
            $compte->datecreation,
            $compte->estactif,
            $compte->id
        );

        }
        return false;
    }

   


    
    
}