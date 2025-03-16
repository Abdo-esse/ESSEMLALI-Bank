<?php
namespace App\Repository;
use PDO;
use App\models\Employe;


class EmployRepository  extends BaseRepository
{

    private $table;
    private $tablePivot;
    
    public function __construct() {
        parent::__construct(); 
        $this->table='users';
        $this->tablePivot='role_user';
    }
    
    public function addAdmin($data ){
        
        $this->conn->beginTransaction(); 
        try {
            $emplyeId = $this->createAction($this->table, $data);
            if (empty($emplyeId)) {
                throw new PDOException("Erreur lors de l'insertion d'admin."); 
            }
            if (!$this->createAction($this->tablePivot,["user_id"=>$emplyeId,"role_id"=>2])) {
                throw new PDOException("Erreur lors de l'insertion du role ."); 
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
            $admins[] = new Employe($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
        }
        return $admins;
    }

   



}