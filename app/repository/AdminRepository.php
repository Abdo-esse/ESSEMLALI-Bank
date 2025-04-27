<?php

namespace App\Repository;

use PDO;
use App\models\Admin;


class AdminRepository extends BaseRepository
{

    private $table;
    private $tablePivot;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->tablePivot = 'role_user';
    }

    public function create($data)
    {

        $this->conn->beginTransaction();
        try {
            $AdminId = $this->createAction($this->table, $data);
            if (empty($AdminId)) {
                throw new PDOException("Erreur lors de l'insertion d'admin.");
            }
            if (!$this->createAction($this->tablePivot, ["user_id" => $AdminId, "role_id" => 1])) {
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
            $admins[] = new Admin($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
        }
        return $admins;
    }


}