<?php
namespace App\Repository;
use PDO;



class StatistiqueAdminRepository  extends BaseRepository
{

    public function nbrClient(){
        $sql = "SELECT COUNT(*) AS total_clients 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE AND ru.role_id = 3";    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_clients'] ?? 0;
    }
    public function nbrClientParMois(){
        $sql = "SELECT COUNT(*) AS total_clients_par_mois 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE 
                  AND ru.role_id = 3
                  AND EXTRACT(MONTH FROM date_creation) = EXTRACT(MONTH FROM CURRENT_DATE)
                  AND EXTRACT(YEAR FROM date_creation) = EXTRACT(YEAR FROM CURRENT_DATE)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_clients_par_mois'] ?? 0; 
    }
    public function nbrEmployer(){
        $sql = "SELECT COUNT(*) AS total_employer 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE AND ru.role_id = 2";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_employer'] ?? 0;
    }
    public function nbrEmployerParMois(){
        $sql = "SELECT COUNT(*) AS total_employer_par_mois 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = TRUE 
                  AND ru.role_id = 2
                  AND EXTRACT(MONTH FROM date_creation) = EXTRACT(MONTH FROM CURRENT_DATE)
                  AND EXTRACT(YEAR FROM date_creation) = EXTRACT(YEAR FROM CURRENT_DATE)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_employer_par_mois'] ?? 0; 
    }
    public function nbrHistorique(){
        $sql = "SELECT count(*) as total_historiques from historique";        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_historiques'] ?? 0; 
    }
    public function totalSolde(){
        $sql = "SELECT sum(solde) as total_solde  from comptes";        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_solde'] ?? 0; 
    }
    
    
}