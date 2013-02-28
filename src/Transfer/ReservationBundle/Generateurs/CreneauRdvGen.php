<?php
namespace Transfer\ReservationBundle\Generateurs;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreneauRdvGen
 *
 * @author Grumpf
 *  
 * 
 * 
 */
class CreneauRdvGen {
    private $CreneauxModeles;
    private $week;
    private $year;
    
    private $CreneauxRdvs;
    
    /**
     * init 
     * 
     * constructeur de la classe CreneauRdvGen
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $creneauxModeles
     * @param integer $week
     * @param integer $year
     */ 

    
    public function __construct(){
        $this->CreneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->CreneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    public function init( $creneauxModeles, $week,  $year){
        
        $this->CreneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach($creneauxModeles as $creneauModele){
            $this->CreneauxModeles->add($creneauModele);
        }
        $this->week = $week;
        $this->year = $year;    
        $this->CreneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function setCreneauxModeles($creneauxModeles){                

        foreach($creneauxModeles as $creneauModele){
            $this->CreneauxModeles->add($creneauModele);
        }
    }
    
    public function getWeek(){
        return $this->week;
    }
    public function getYear(){
        return $this->year;
    }
    public function setWeek($week){
        $this->week = $week;
        return $this;
    }
    public function setYear($year){
        $this->year = $year;
        return $this;
    }

    public function getCreneauxRdvs(){
        return $this->CreneauxRdvs;
    }

    
    /**
     * 
     */
    
    public function generateCreneauxRdvs(){
        
        foreach($this->CreneauxModeles as $creneauModele){
            $this->CreneauxRdvs->add(new \Transfer\ReservationBundle\Entity\CreneauRdv());
            $this->CreneauxRdvs->last()->setDisponibilite($creneauModele->getDisponibilite());
            $this->CreneauxRdvs->last()->setDuree($creneauModele->getDuree());
            $this->CreneauxRdvs->last()->setHeure($creneauModele->getHeure());
            $this->CreneauxRdvs->last()->setMinute($creneauModele->getMinute());
            $this->CreneauxRdvs->last()->setHeureDebut($creneauModele->getHeureDebut());
            $this->CreneauxRdvs->last()->setHeureFin($creneauModele->getHeureFin());
            $this->CreneauxRdvs->last()->setJour($creneauModele->getJour());
            $this->CreneauxRdvs->last()->setTypePoste($creneauModele->getTypePoste());
            $this->CreneauxRdvs->last()->setAnnee($this->year);
            $this->CreneauxRdvs->last()->setSemaine($this->week);           
        }   
    }
   
}

?>
