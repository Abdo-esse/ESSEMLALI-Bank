<?php
namespace App\Repository;
use PDO;
class UserRepository  extends BaseRepository
{

    public function __construct() {
        parent::__construct(); 
    }
    
    public function findByEmail( $table,$email) {
        $stmt = $this->conn->prepare("SELECT u.*, STRING_AGG(r.titre, ',') AS role
                                      FROM $table u
                                      JOIN role_user ru ON u.id = ru.user_id 
                                      JOIN roles r ON ru.role_id = r.id 
                                      WHERE u.email = :email
                                      GROUP BY u.id;");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByNumber($number){
        return $this->find('clients',["telephone"=>$number]);
    }

   



}