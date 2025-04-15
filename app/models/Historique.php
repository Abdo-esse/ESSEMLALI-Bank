<?php
 namespace App\models;
 
class Historique {
    private $id;
    private $id_donneur;
    private  $id_beneficiaire;
    private $type_operation;
    private  $montant;
    private  $description;
    private $dateEffectue;

    public function __construct($id,$id_donneur,$type_operation,$montant,$dateEffectue,$id_beneficiaire=null,$description = null)
    {
        $this->id = $id;
        $this->id_donneur = $id_donneur;
        $this->id_beneficiaire = $id_beneficiaire;
        $this->type_operation = $type_operation;
        $this->montant = $montant;
        $this->description = $description;
        $this->dateEffectue = $dateEffectue ;
    }

    
    public function getId() { return $this->id; }
    public function getIdDonneur(){ return $this->id_donneur; }
    public function getIdBeneficiaire() { return $this->id_beneficiaire; }
    public function getTypeOperation(){ return $this->type_operation; }
    public function getMontant() { return $this->montant; }
    public function getDescription() { return $this->description; }
    public function getDateEffectue() { return $this->dateEffectue; }

    
    public function setIdDonneur( $id) { $this->id_donneur = $id; }
    public function setIdBeneficiaire( $id) { $this->id_beneficiaire = $id; }
    public function setTypeOperation ($type) { $this->type_operation = $type; }
    public function setMontant( $montant) { $this->montant = $montant; }
    public function setDescription( $desc) { $this->description = $desc; }
    public function setDateEffectue ($date) { $this->dateEffectue = $date; }
}
