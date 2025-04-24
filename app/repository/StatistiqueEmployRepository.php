<?php
namespace App\Repository;
use PDO;



class StatistiqueEmployRepository  extends BaseRepository
{

    public function nbrCompte(){
        $sql = "SELECT count(*) AS total_comptes
                from comptes
                where estactif=true";    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_comptes'] ?? 0;
    }
    public function nbrCompteParMois(){
        $sql = "SELECT count(*) as total_comptes_par_mois
                from comptes
                where estactif=true
                and extract(month from datecreation )= extract(month from current_date)
                and extract(year from datecreation )= extract(year from current_date)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_comptes_par_mois'] ?? 0; 
    }
    public function nbrDemandes(){
        $sql = "SELECT COUNT(*) AS total_demande
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = false and users.date_suppression is null AND ru.role_id = 3";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_demande'] ?? 0;
    }
    public function nbrDemandesParMois(){
        $sql = "SELECT COUNT(*) AS total_demande_par_mois 
                FROM users 
                JOIN role_user ru ON ru.user_id = users.id
                WHERE users.is_active = false 
                AND ru.role_id = 3
                AND EXTRACT(MONTH FROM date_creation) = EXTRACT(MONTH FROM CURRENT_DATE)
                AND EXTRACT(YEAR FROM date_creation) = EXTRACT(YEAR FROM CURRENT_DATE)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $result['total_demande_par_mois'] ?? 0; 
    }
    
    
    
}