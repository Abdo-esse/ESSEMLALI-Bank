<?php
 namespace App\models;
 use JsonSerializable;

 class User  implements JsonSerializable
 {

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $dateCreation;
    private $isActive;

    public function __construct($id, $nom, $prenom,$email,$motDePasse,$dateCreation,$isActive) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->setMotDePasse($motDePasse);
        $this->dateCreation = $dateCreation;
        $this->isActive = $isActive;
    }

    public function getId(){ return $this->id;}
    public function setId($id){ $this->id = $id;}

    public function getNom(){ return $this->nom;}
    public function setNom($nom){ $this->nom = $nom;}

    public function getprenom(){ return $this->prenom;}
    public function setprenom($prenom){ $this->prenom = $prenom;}

    public function getEmail(){ return $this->email;}
    public function setEmail($email){ $this->email = $email;}

    public function getMotDePasse(){ return $this->motDePasse;}
    public function setMotDePasse($motDePasse){  $this->motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);}

    public function getDateCreation(){ return $this->dateCreation;}
    public function setDateCreation($dateCreation){ $this->dateCreation = $dateCreation;}

    public function getIsActive(){ return $this->isActive;}
    public function setIsActive($isActive){ $this->isActive = $isActive;}

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' =>  $this->email,
            'dateCreation' => $this->dateCreation,
            'isActive' =>  $this->isActive,
        ];
    }
 }