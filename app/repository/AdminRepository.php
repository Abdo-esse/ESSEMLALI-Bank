<?php
namespace App\Repository;
use PDO;


class AdminRepository  extends BaseRepository
{

    public function __construct() {
        parent::__construct(); 
    }
    
    public function addAmin(){

    }

    public function updateCoursTags()
    {
        $conn->beginTransaction(); 

try {
    
    $sqlDelete = "DELETE FROM cours_tags WHERE idCours = ?";
    $stmt = $conn->prepare($sqlDelete);
    if (!$stmt->execute([$this->id])) {
        throw new PDOException("Erreur lors de la suppression des tags."); 
    }

  
    foreach($this->idTags as $idTag )
    {
    $sqlInsert = "INSERT INTO cours_tags (idCours, idTags) VALUES (?, ?)";
    $stmt = $conn->prepare($sqlInsert);
    if (!$stmt->execute([$this->id, $idTag])) {
        throw new PDOException("Erreur lors de l'insertion des nouveaux tags."); 
    }
    }
    $conn->commit(); 
} catch (PDOException $e) {
    $conn->rollBack(); 
    echo "Erreur : " . $e->getMessage();
}


    }

   



}