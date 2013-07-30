<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Transfer\ReservationBundle\Generateurs;
use Exception;
use \Transfer\ReservationBundle\Entity\Disponibilite;
use Doctrine\ORM\EntityManager;
use Transfer\ReservationBundle\Services\AccesParametres;

/**
 * Description of CreneauModeleGen
 *
 * @author Grumpf
 */

use Transfer\ReservationBundle\Entity\CreneauModele;

class CreneauModeleGen {
    //put your code here
    
    private $heureDebut;
    private $minDebut;
    private $heureFin;
    private $minFin; //min
    private $pasDeTemps;
    private $disponibiliteTotale;
    private $creneauxModeles;
    private $typePoste;
    private $disponibilites;
    private $moteurReservation;
    private $statut;
    
    /**
     * Constructeur de la classe
     * Permet de transmettre les paramètres 
     */   
    public function __construct(\Transfer\ReservationBundle\Services\MoteurReservation $mR)
    {
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->disponibilites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moteurReservation = $mR;
 
    }
    
    public function getCreneauxModeles(){
        if (!$this->creneauxModeles) {
            throw new Exception('Aucun créneau modèle généré');
        }
        else return $this->creneauxModeles;
    }      
    
    public function setDisponibiliteTotale($disponibiliteTotale){
        return $this->disponibiliteTotale=$disponibiliteTotale;
    }
   public function setHeureDebut($heureDebut){
       return $this->heureDebut= $heureDebut;
   }
   public function setMinDebut($minuteDebut){
       return $this->minDebut= $minuteDebut;
   } 
   public function setHeureFin($heureFin){
       return $this->heureFin=$heureFin;
   }
   public function setMinFin($minuteFin){
       return $this->minFin=$minuteFin;
   }
   public function setPasDeTemps($pasDeTemps){
       return $this->pasDeTemps=$pasDeTemps;
   }
   public function setTypePoste($typePoste){
       return $this->typePoste=$typePoste;
   }
    public function getDisponibiliteTotale(){
        return $this->disponibiliteTotale;
    }
   public function getHeureDebut(){
       return $this->heureDebut;
   }
   public function getMinDebut(){
       return $this->minDebut;
   } 
   public function getHeureFin(){
       return $this->heureFin;
   }
   public function getMinFin(){
       return $this->minFin;
   }
   public function getPasDeTemps(){
       return $this->pasDeTemps;
   }
   public function getTypePoste(){
       return $this->typePoste;
   }  
   public function getDisponibilites() {
       return $this->disponibilites;
   }

   public function setDisponibilites($disponibilites) {
       $this->disponibilites = $disponibilites;
   }

   public function getStatut() {
       return $this->statut;
   }

   public function setStatut($statut) {
       $this->statut = $statut;
   }

       /**
     * function init
     * 
     * Permet d'initialiser la classe en dehors du constructeur     * 
     * 
     * @param type $_heureDebut
     * @param type $_minDebut
     * @param type $_minFin
     * @param type $_heureFin
     * @param type $_pasDeTemps
     * @param type $_disponibiliteTotale
     * @param \Transfer\ReservationBundle\Entity\TypePoste $typePoste
     */    
    public function init($_heureDebut,$_minDebut, $_minFin,
            $_heureFin,$_pasDeTemps, $_disponibiliteTotale,
            \Transfer\ReservationBundle\Entity\TypePoste $typePoste,
            \Transfer\ReservationBundle\Entity\StatutCreneau $statut)
    {        
        $this->typePoste= $typePoste;
        $this->heureDebut = $_heureDebut;
        $this->heureFin= $_heureFin;
        $this->minDebut= $_minDebut;
        $this->minFin= $_minFin;
        $this->pasDeTemps = $_pasDeTemps;      
        $this->disponibiliteTotale = $_disponibiliteTotale;
        $this->statut = $statut;
    }
    
            
    /**
     * Méthode Générate :
     * Permet de générer les modèles de créneaux sur une semaine générique
     * à partir des propriétés du générateur
     * 
     * 
     */
    
    public function generate() {
        
        $minDebutTot = $this->heureDebut*60+$this->minDebut;
        $minFinTot =$this->heureFin*60+$this->minFin;
        
                
        for ($i = 1; $i <= 6; $i++) {
            for ($min = $minDebutTot; $min <=$minFinTot; $min=$min+$this->pasDeTemps){
                $this->creneauxModeles->add(new CreneauModele());
                $this->creneauxModeles->last()->init(                
                        $this->disponibiliteTotale,                           //disponibiliteTotale
                        $i,                                             //jour
                        floor($min/60),                                 //heure
                        $min-floor($min/60)*60,                         //min 
                        $this->pasDeTemps,                              //durée
                        $this->typePoste,
                        $this->statut);                             //poste      
                }
        }          
        $this->moteurReservation->fixDisponibilites($this->creneauxModeles, array('persist'=>false));        
    }  
}


?>
