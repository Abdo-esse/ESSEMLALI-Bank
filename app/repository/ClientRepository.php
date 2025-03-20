<?php
namespace App\Repository;
use PDO;
use App\models\Admin;


class ClientRepository  extends BaseRepository
{

    private $table;
    private $tableClient;
    private $tablePivot;
    
    public function __construct() {
        parent::__construct(); 
        $this->table='users';
        $this->tableClient='users';
        $this->tablePivot='role_user';
    }
    
    public function create($dataUser, $dataClient ){
        
        $this->conn->beginTransaction(); 
        try {
            $clientId = $this->createAction($this->table, $dataUser);
            if (empty($clientId)) {
                throw new PDOException("Erreur lors de l'insertion d'user."); 
            }
            if (!$this->createAction($this->tablePivot,["user_id"=>$clientId,"role_id"=>1])) {
                throw new PDOException("Erreur lors de l'insertion du role ."); 
            }
            if (!$this->createAction($this->tableClient, $dataClient)) {
                throw new PDOException("Erreur lors de l'insertion du client ."); 
            }
            $this->conn->commit(); 
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack(); 
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function readAll($table)
    {
        $sql = "select u.* 
               from $this->table u
               join $this->tablePivot on role_user.user_id = u.id
               join $table on roles.id= role_user.role_id
               where roles.titre='Admin'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $admins = [];
        foreach ($rows as $row) {
            $admins[] = new Admin($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
        }
        return $admins;
    }

   



}