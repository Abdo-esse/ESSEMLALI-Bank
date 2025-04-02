<?php
namespace App\Repository;

use PDO;
use App\Models\Client;
use App\Models\User;

class ClientRepository extends BaseRepository
{
    private $table;
    private $tableClient;
    private $tablePivot;

    public function __construct() {
        parent::__construct();
        $this->table = 'users';
        $this->tableClient = 'clients';
        $this->tablePivot = 'role_user';
    }

    public function create($dataUser, $dataClient) {
        $this->conn->beginTransaction();
        try {
            $clientId = $this->createAction($this->table, $dataUser);
            if (empty($clientId)) {
                throw new PDOException("Erreur lors de l'insertion d'user.");
            }

            if (!$this->createAction($this->tablePivot, ["user_id" => $clientId, "role_id" => 3])) {
                throw new PDOException("Erreur lors de l'insertion du role.");
            }

            $dataClient['user_id'] = $clientId;
            if (!$this->createAction($this->tableClient, $dataClient)) {
                throw new PDOException("Erreur lors de l'insertion du client.");
            }

            $this->conn->commit();
            return $clientId;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function readAll($table) {
        $sql = "SELECT u.*, c.* 
                FROM $this->table AS u
                JOIN $this->tablePivot AS ru ON ru.user_id = u.id
                JOIN roles AS r ON r.id = ru.role_id
                JOIN $this->tableClient AS c ON c.user_id = u.id
                WHERE r.titre = 'Client' AND u.is_active = 'false' AND date_suppression IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $clients = [];

        foreach ($rows as $row) {
            $clients[] = new Client(
                $row->user_id,
                $row->nom,
                $row->prenom,
                $row->email,
                "",
                $row->date_creation,
                $row->is_active,
                $row->id,
                $row->sexe,
                $row->telephone,
                $row->address,
                $row->carte_national
            );
        }

        return $clients;
    }

    public function find($table, $where) {
        $sql = "SELECT u.*, c.* 
                FROM $this->table AS u
                JOIN $this->tablePivot AS ru ON ru.user_id = u.id
                JOIN roles AS r ON r.id = ru.role_id
                JOIN $this->tableClient AS c ON c.user_id = u.id
                WHERE r.titre = 'Client' AND u.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $where]);

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$row) {
            return null;
        }

        return new Client(
            $row->user_id,
            $row->nom,
            $row->prenom,
            $row->email,
            "",
            $row->date_creation,
            $row->is_active,
            $row->id,
            $row->sexe,
            $row->telephone,
            $row->address,
            $row->carte_national
        );
    }

    public function allClient() {
        $sql = "SELECT u.*
                FROM $this->table AS u
                JOIN $this->tablePivot AS ru ON ru.user_id = u.id
                JOIN roles AS r ON r.id = ru.role_id
                WHERE r.titre = 'Client' AND is_active = 'true' AND date_suppression IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $clients = [];

        foreach ($rows as $row) {
            $clients[] = new User(
                $row->id,
                $row->nom,
                $row->prenom,
                $row->email,
                "",
                $row->date_creation,
                $row->is_active
            );
        }

        return $clients;
    }
}
?>
