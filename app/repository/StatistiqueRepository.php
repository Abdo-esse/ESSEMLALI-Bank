<?php
namespace App\Repository;
use PDO;



class StatistiqueRepository  extends BaseRepository
{

    public function nbrClient(){
        $sql = "SELECT COUNT(*) AS total_utilisateurs 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE AND ru.role_id = 3";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_utilisateurs'] ?? 0;
    }
    public function nbrClientParMois(){
        $sql = "SELECT COUNT(*) AS total_utilisateurs_par_mois 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE 
                  AND ru.role_id = 3
                  AND EXTRACT(MONTH FROM date_creation) = EXTRACT(MONTH FROM CURRENT_DATE)
                  AND EXTRACT(YEAR FROM date_creation) = EXTRACT(YEAR FROM CURRENT_DATE)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_utilisateurs_par_mois'] ?? 0; 
    }
    
    
}