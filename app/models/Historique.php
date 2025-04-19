<?php
 namespace App\models;

class Historique {
    private $id;
    private $donneur;
    private  $beneficiaire;
    private $typeOperation;
    private  $montant;
    private  $description;
    private $dateEffectue;

    public function __construct($id,$donneur,$typeOperation,$montant,$dateEffectue,$beneficiaire,$description)
    {
        $this->id = $id;
        $this->donneur = $donneur;
        $this->beneficiaire = $beneficiaire;
        $this->typeOperation = $typeOperation;
        $this->montant = $montant;
        $this->description = $description;
        $this->dateEffectue = $dateEffectue ;
    }

    
    public function getId() { return $this->id; }
    public function getDonneur(){ return $this->donneur; }
    public function getBeneficiaire() { return $this->beneficiaire; }
    public function getTypeOperation(){ return $this->typeOperation; }
    public function getMontant() { return $this->montant; }
    public function getDescription() { return $this->description; }
    public function getDateEffectue() { return $this->dateEffectue; }

    
    public function setIdDonneur( $id) { $this->donneur = $id; }
    public function setIdBeneficiaire( $id) { $this->beneficiaire = $id; }
    public function setTypeOperation ($type) { $this->typeOperation = $type; }
    public function setMontant( $montant) { $this->montant = $montant; }
    public function setDescription( $desc) { $this->description = $desc; }
    public function setDateEffectue ($date) { $this->dateEffectue = $date; }
}
