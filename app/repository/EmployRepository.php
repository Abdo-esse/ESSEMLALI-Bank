<?php

namespace App\Repository;

use PDO;
use App\models\Employe;


class EmployRepository extends BaseRepository
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
            $emplyeId = $this->createAction($this->table, $data);
            if (empty($emplyeId)) {
                throw new PDOException("Erreur lors de l'insertion d'admin.");
            }
            if (!$this->createAction($this->tablePivot, ["user_id" => $emplyeId, "role_id" => 2])) {
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
              WHERE roles.titre = 'Employé' AND u.date_suppression IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employes = [];
        foreach ($rows as $row) {
            $employes[] = new Employe($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
        }
        return $employes;
    }

    public function find($table, $where)
    {
        $sql = "SELECT u.* 
                FROM {$this->table} u
                JOIN role_user ru ON ru.user_id = u.id
                JOIN {$table} r ON r.id = ru.role_id
                WHERE r.titre = 'Employé' AND u.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $where]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Employe($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
    }

    public function searchEmployes($keyword)
    {
        $sql = "SELECT u.* 
               from $this->table u
               join $this->tablePivot on role_user.user_id = u.id
               WHERE role_user.role_id = 2 AND u.date_suppression IS NULL
				AND ( LOWER(u.prenom) LIKE LOWER(:keyword) OR LOWER(u.nom) LIKE LOWER(:keyword))
				ORDER BY u.nom";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":keyword" => $keyword . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $employes = [];
        foreach ($rows as $row) {
            $employes[] = new Employe($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['date_creation'], $row['is_active']);
        }
        return $employes;
    }


}