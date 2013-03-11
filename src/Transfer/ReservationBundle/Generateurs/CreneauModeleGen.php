<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Transfer\ReservationBundle\Generateurs;
use Exception;

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
    private $disponibilite;
    private $CreneauxModeles;
    private $typePoste;
    
    public function getCreneauxModels(){
        if (!$this->CreneauxModeles) {
            throw new Exception('Aucun créneau modèle généré');
        }
        else return $this->CreneauxModeles;
    }
      
    
    public function setDisponibilite($disponibilite){
        return $this->disponibilite=$disponibilite;
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
    public function getDisponibilite(){
        return $this->disponibilite;
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
   

   
   /**
     * Constructeur de la classe
     * Permet de transmettre les paramètres 
     */
    
    
    public function __construct()
    {
        $this->CreneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
 
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
     * @param type $_disponibilite
     * @param \Transfer\ReservationBundle\Entity\TypePoste $typePoste
     */
    
    
    
    public function init($_heureDebut,$_minDebut, $_minFin,
            $_heureFin,$_pasDeTemps, $_disponibilite,
            \Transfer\ReservationBundle\Entity\TypePoste $typePoste)
    {
        $this->CreneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->typePoste= $typePoste;
        $this->heureDebut = $_heureDebut;
        $this->heureFin= $_heureFin;
        $this->minDebut= $_minDebut;
        $this->minFin= $_minFin;
        $this->pasDeTemps = $_pasDeTemps;      
        $this->disponibilite = $_disponibilite;
    }
    
    /**
     * Méthode Générator :
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
