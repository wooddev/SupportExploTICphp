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
    
    private $creneauModele,
            $disponibilite,
            $etatReservation,
            $transporteur;
    
    public function getCreneauModele(){
        if (!$this->CreneauxModeles) {
            throw new Exception('Aucun créneau modèle associé');
        }
        else return $this->CreneauxModeles;
    }
    
    public function setCreneauModele($creneauModele){
        $this->creneauModele = $creneauModele;
        return $ths;
    }
    
    public function getDisponibilite(){
        return $this->disponibilite;
    }
    
    public function setDisponibilite($disponbilite){
        $this->disponibilite = $disponbilite;
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
   
    public function init($creneauModele, $disponibilite, $etatReservation,$transporteur)
    {
        $this->CreneauModele = $creneauModele;        
        $this->disponibilite = $_disponibilite;
        $this->etatReservation= $etatReservation;
        $this->transporteur = $transporteur;
    }
    
    /**
     * Méthode Générator :
     * Permet de générer les modèles de créneaux sur une semaine générique
     * à partir des propriétés du générateur
     * 
     * 
     */
    
    public function generate() {
        
        
                
        for ($i = 1; $i <= 6; $i++) {
            for ($min = $minDebutTot; $min <=$minFinTot; $min=$min+$this->pasDeTemps){
                $this->CreneauxModeles->add(new CreneauModele());
                $this->CreneauxModeles->last()->init(                
                        $this->disponibilite,                           //disponibilite
                        $i,                                             //jour
                        floor($min/60),                                 //heure
                        $min-floor($min/60)*60,                         //min 
                        $this->pasDeTemps,                              //durée
                        $this->typePoste);                             //poste
            }
        }    
        
    }
    

   
   
   
}


?>
