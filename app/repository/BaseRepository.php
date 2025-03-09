<?php

namespace App\Repository;
use App\config\Connexion;
use PDO;

class BaseRepository
{
    protected $conn;
    public function __construct() {
        $this->conn = Connexion::connexion();
    }

    public function createAction($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array_values($data));
        return $conn->lastInsertId();
    }

    public function readAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function readAction($table, $where)
    {
        $column = key($where);
        $sql = "SELECT * FROM $table WHERE $column = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_values($where));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateAction($table, $id, $data)
    {
        $columns = implode(' = ?, ', array_keys($data)) . ' = ?';
        $sql = "UPDATE $table SET $columns WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array_merge(array_values($data), [$id]));
    }

    public function deleteAction($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
