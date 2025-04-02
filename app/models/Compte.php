<?php
namespace App\models;

class Compte 
{
    private Client $client;
    private $numeroCompte;
    private $solde;
    private $dateCreation;
    private $estActif;

    public function __construct($client,$numeroCompte, $solde, $dateCreation, $estActif)
    {
        $this->client = $client;
        $this->numeroCompte = $numeroCompte;
        $this->solde = $solde;
        $this->dateCreation = $dateCreation;
        $this->estActif = $estActif;
    }

    
    public function getNumeroCompte(){return $this->numeroCompte;}
    public function getSolde(){return $this->solde;}
    public function getDateCreation(){return $this->dateCreation;}
    public function getEstActif(){return $this->estActif;}

    
    public function setNumeroCompte($numeroCompte){$this->numeroCompte = $numeroCompte;}
    public function setSolde($solde){$this->solde = $solde;}
    public function setDateCreation($dateCreation){$this->dateCreation = $dateCreation;}
    public function setEstActif($estActif){$this->estActif = $estActif;}
}
