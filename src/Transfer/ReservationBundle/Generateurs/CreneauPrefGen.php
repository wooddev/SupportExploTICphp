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

use Transfer\ReservationBundle\Entity\CreneauPref;

class CreneauPrefGen {
    //put your code here  
    
    private $moteurReservation,
            //Créneaux Modèles disponibles
            $creneauxModeles,
            //Options choisies par l'utilisateur
            $transporteur,
            $typeCamion,
            // Créneaux prefs générés
            $creneauxPrefs;


       
    public function __construct(\Transfer\ReservationBundle\Services\MoteurReservation $moteurReservation){
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauxPrefs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moteurReservation = $moteurReservation;        
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
    
    public function getTransporteur(){
        return $this->transporteur;
    }
   
    public function setTransporteur(\Transfer\ProfilBundle\Entity\Transporteur $transporteur){
        $this->transporteur = $transporteur;
        return $this->transporteur;
    }     
    
    public function getTypeCamion() {
        return $this->typeCamion;
    }

    public function setTypeCamion(\Transfer\ReservationBundle\Entity\TypeCamion $typeCamion) {
        $this->typeCamion = $typeCamion;
    }
        
    /**
     * function init
     * 
     * Permet d'initialiser la classe en dehors du constructeur     * 

     */
   
    public function init($creneauxModeles,$transporteur,$typeCamion)
    {
        $this->creneauxModeles = $creneauxModeles;    
        $this->transporteur = $transporteur;
        $this->typeCamion = $typeCamion;
    }
    
    public function reserver(){
        foreach($this->creneauxModeles as $creneauModele){
            $this->moteurReservation->reservation($creneauModele, $this->typeCamion,$this->transporteur);
        }        
    }

   
   
   
}


?>
