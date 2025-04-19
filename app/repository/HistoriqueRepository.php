<?php
namespace App\Repository;

use App\Models\User;
use App\Models\Historique;
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
                h.id as h_id,h.type_operation as h_type_operation,h.montant as h_montant,h.description as h_description,h.dateeffectue as h_dateeffectue,
                u_donneur.id as d_id,u_donneur.nom as d_nom,u_donneur.prenom as d_prenom,
                u_beneficiaire.id as b_id,u_beneficiaire.nom as b_nom,u_beneficiaire.prenom as b_prenom 
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

                WHERE u.id = :id
                ORDER BY h_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
    
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        $historiques=[];
    
        if (!$rows) {
            return null;
        }

        foreach($rows as $row)
        {

            $donneur=new User($row->d_id,$row->d_nom,$row->d_prenom,null,null,null,null);
            $beneficiaire = null;
             if ($row->b_id !== null) {
            $beneficiaire = new User($row->b_id, $row->b_nom, $row->b_prenom, null, null, null, null);
             }

            $historiques[]= new Historique($row->h_id,$donneur,$row->h_type_operation,$row->h_montant,$row->h_dateeffectue, $beneficiaire,$row->h_description);
        }
        return $historiques;
    }
    
    
    
}