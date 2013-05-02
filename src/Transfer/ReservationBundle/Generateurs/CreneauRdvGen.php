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
    private $creneauxModeles;
    private $week;
    private $year;
    
    private $creneauxRdvs;
    
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
        $this->creneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    public function init( $creneauxModeles, $week,  $year){
        
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach($creneauxModeles as $creneauModele){
            $this->creneauxModeles->add($creneauModele);
        }
        $this->week = $week;
        $this->year = $year;    
        $this->creneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function setCreneauxModeles($creneauxModeles){                

        foreach($creneauxModeles as $creneauModele){
            $this->creneauxModeles->add($creneauModele);
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
        return $this->creneauxRdvs;
    }

    
    /**
     * 
     */
    
    public function generateCreneauxRdvs(){
        
        foreach($this->creneauxModeles as $creneauModele){
            $this->creneauxRdvs->add(new \Transfer\ReservationBundle\Entity\CreneauRdv());
            $this->creneauxRdvs->last()->setDisponibiliteTotale($creneauModele->getDisponibiliteTotale());
            $this->creneauxRdvs->last()->setDuree($creneauModele->getDuree());
            $this->creneauxRdvs->last()->setHeure($creneauModele->getHeure());
            $this->creneauxRdvs->last()->setMinute($creneauModele->getMinute());
            $this->creneauxRdvs->last()->setHeureDebut($creneauModele->getHeureDebut());
            $this->creneauxRdvs->last()->setHeureFin($creneauModele->getHeureFin());
            $this->creneauxRdvs->last()->setJour($creneauModele->getJour());
            $this->creneauxRdvs->last()->setTypePoste($creneauModele->getTypePoste());
            $this->creneauxRdvs->last()->setAnnee($this->year);
            $this->creneauxRdvs->last()->setSemaine($this->week);   
            $this->creneauxRdvs->last()->calculDateTime();
            foreach($creneauModele->getDisponibilites() as $disponibilite){
                $this->creneauxRdvs->last()
                        ->AddDisponibilite(
                                new \Transfer\ReservationBundle\Entity\Disponibilite(
                                        $disponibilite->getValeur(),
                                        $disponibilite->getTypeCamion(),
                                        $this->creneauxRdvs->last()));
            }
            
        }   
    }
   
}

?>
