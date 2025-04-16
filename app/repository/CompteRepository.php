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
            return new Compte($compte->numerocompte,$compte->solde,$compte->datecreation,$compte->estactif,$compte->id,$compte->client_id);
        }
        return false;
    }


   public function virement($dataSendre,$dataRecipient){
        
        $this->conn->beginTransaction(); 
        try {
            if (!$this->update($this->table, $dataSendre["id"],["solde"=>$dataSendre["solde"]])) {
                throw new PDOException("Erreur lors de l'update du sendre."); 
            }
            if (!$this->update($this->table, $dataRecipient["id"],["solde"=>$dataRecipient["solde"]])) {
                throw new PDOException("Erreur lors de l'update du recipeint ."); 
            }
            $this->conn->commit(); 
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack(); 
            echo "Erreur : " . $e->getMessage();
        }
    }


    
    
}