<?php
namespace App\Repository;
use PDO;


class AdminRepository  extends BaseRepository
{

    private $table;
    private $tablePivot;
    
    public function __construct() {
        parent::__construct(); 
        $this->table='';
        $this->tablePivot='';
    }
    
    public function addAmin($data ){
        
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
        } catch (PDOException $e) {
            $this->conn->rollBack(); 
            echo "Erreur : " . $e->getMessage();
        }
    }



   



}