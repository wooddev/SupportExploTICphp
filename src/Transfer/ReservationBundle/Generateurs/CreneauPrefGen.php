<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Transfer\ReservationBundle\Generateurs;
use Exception;

/**
 * Description of CreneauPrefGen
 *
 * @author Adrien
 */

use Transfer\ReservationBundle\Entity\CreneauModele;

class CreneauPrefGen {
    //put your code here  
    
    private $creneauxModeles,
            $disponibiliteTotale,
            $etatReservation,
            $transporteur,
            $creneauxPrefs;
    
    public function __construct(){
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauxPrefs = new \Doctrine\Common\Collections\ArrayCollection();
        return $this;
    }
    
    public function getCreneauxModeles(){
        if (!$this->creneauxModeles) {
            throw new Exception('Aucun créneau modèle associé');
        }
        else return $this->creneauxModeles;
    }
    public function setCreneauxModeles($collection){
        $this->creneauxModeles = $collection;
        return $this;
    }
    
    public function addCreneauModele($creneauModele){
        $this->creneauxModeles->Add($creneauModele);
        return $this;
    }
    
    public function getCreneauxPrefs(){
        if (!$this->creneauxPrefs) {
            throw new Exception('Aucun créneau modèle associé');
        }
        else return $this->creneauxPrefs;
    }
    
    public function getDisponibiliteTotale(){
        return $this->disponibiliteTotale;
    }
    
    public function setDisponibiliteTotale($disponbilite){
        $this->disponibiliteTotale = $disponbilite;
        return $this;
    }
    
    public function getEtatReservation(){
        return $this->etatReservation;
    }
    
    public function setEtatReservation($etat){
        $this->etatReservation = $etat;
        return $this;
    }
    
    public function getTransporteur(){
        return $this->transporteur;
    }
   
    public function setTransporteur($transporteur){
        $this->transporteur = $transporteur;
        return $this->transporteur;
    }
   
    
    /**
     * function init
     * 
     * Permet d'initialiser la classe en dehors du constructeur     * 

     */
   
    public function init($creneauxModeles, $disponibiliteTotale, $etatReservation,$transporteur)
    {
        $this->creneauxModeles = $creneauxModeles;        
        $this->disponibiliteTotale = $disponibiliteTotale;
        $this->etatReservation= $etatReservation;
        $this->transporteur = $transporteur;
    }

   
   
   
}


?>
