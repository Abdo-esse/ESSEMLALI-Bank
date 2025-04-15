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
            return new Compte($compte->numerocompte,$compte->solde,$compte->datecreation,$compte->estactif,$compte->id);
        }
        return false;
    }


   public function virement($data ){
        
        $this->conn->beginTransaction(); 
        try {
            $AdminId = $this->createAction($this->table, $data);
            if (empty($AdminId)) {
                throw new PDOException("Erreur lors de l'insertion d'admin."); 
            }
            if (!$this->createAction($this->tablePivot,["user_id"=>$AdminId,"role_id"=>1])) {
                throw new PDOException("Erreur lors de l'insertion du role ."); 
            }
            $this->conn->commit(); 
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack(); 
            echo "Erreur : " . $e->getMessage();
        }
    }


    
    
}