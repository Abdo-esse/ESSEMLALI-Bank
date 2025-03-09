<?php
 namespace App\models;

 class Role 
 {

    private $id;
    private $titre;

    public function __construct($id, $titre) {
        $this->id = $id;
        $this->titre = $titre;
    }

    public function getId(){ return $this->id;}
    public function setId($id){ $this->id = $id;}

    public function getTitre(){ return $this->titre;}
    public function setTitre($titre){ $this->titre = $titre;}
 }