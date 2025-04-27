<?php

namespace App\Models;

class Client extends User
{
    private $clientId;
    private $sexe;
    private $telephone;
    private $adresse;
    private $carteIdentite;

    public function __construct($id, $nom, $prenom, $email, $motDePasse, $dateCreation, $isActive, $clientId, $sexe, $telephone, $adresse, $carteIdentite)
    {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse, $dateCreation, $isActive);
        $this->clientId = $clientId;
        $this->sexe = $sexe;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->carteIdentite = $carteIdentite;
    }


    public function getClientId()
    {
        return $this->clientId;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCarteIdentite()
    {
        return $this->carteIdentite;
    }


    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setCarteIdentite($carteIdentite)
    {
        $this->carteIdentite = $carteIdentite;
    }
}