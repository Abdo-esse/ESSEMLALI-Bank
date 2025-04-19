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

    public function getHistorique($id) {
        $sql = "SELECT 
                h.*,
                u_donneur.* ,
                u_beneficiaire.* 
                FROM users u
                JOIN clients c ON c.user_id = u.id
                JOIN comptes co ON co.client_id = c.id
                JOIN historique h ON h.id_donneur = co.id OR h.id_beneficiaire = co.id

                -- Jointures pour récupérer les noms
                LEFT JOIN comptes co_donneur ON co_donneur.id = h.id_donneur
                LEFT JOIN clients c_donneur ON c_donneur.id = co_donneur.client_id
                LEFT JOIN users u_donneur ON u_donneur.id = c_donneur.user_id

                LEFT JOIN comptes co_beneficiaire ON co_beneficiaire.id = h.id_beneficiaire
                LEFT JOIN clients c_beneficiaire ON c_beneficiaire.id = co_beneficiaire.client_id
                LEFT JOIN users u_beneficiaire ON u_beneficiaire.id = c_beneficiaire.user_id

                WHERE u.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
    
        $row = $stmt->fetch(PDO::FETCH_OBJ);
    
        if (!$row) {
            return null;
        }
    
        var_dump($rew);
        exit;
        // $clientObject = new Client($row->user_id,$row->nom,$row->prenom,$row->email,$row->mot_de_passe,$row->date_creation,$row->is_active,$row->id,$row->sexe,$row->telephone,$row->address,$row->carte_national);
    
        // $compteObject = new Compte(
        //     $row->numerocompte,
        //     $row->solde,
        //     $row->datecreation,
        //     $row->estactif
        // );
    
        // return [
        //     'client' => $clientObject,
        //     'compte' => $compteObject
        // ];
    }
    
    
    
}