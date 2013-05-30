<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Explotic\AgendaBundle\Generateurs;
use Exception;


/**
 * Description of CreneauModeleGen
 *
 * @author Arraiolos Adrien
 */

use Explotic\AgendaBundle\Entity\CreneauModele;

class CreneauModeleGen {
    //put your code here
    
    private $heureDebut;
    private $minDebut;
    private $heureFin;
    private $minFin; //min
    private $pasDeTemps;
    private $CreneauxModeles;

    
    public function getCreneauxModels(){
        if (!$this->CreneauxModeles) {
            throw new Exception('Aucun créneau modèle généré');
        }
        else return $this->CreneauxModeles;
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
     */
    
    
    
    public function init($_heureDebut,$_minDebut,$_heureFin,$_minFin,$_pasDeTemps)
    {        
        $this->heureDebut = $_heureDebut;
        $this->heureFin= $_heureFin;
        $this->minDebut= $_minDebut;
        $this->minFin= $_minFin;
        $this->pasDeTemps = $_pasDeTemps;      

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
                        $i,                                             //jour
                        floor($min/60),                                 //heure
                        $min-floor($min/60)*60,                         //min 
                        $this->pasDeTemps                              //durée
                        );                        
                               
            }
        }    
        
    }
    

   
   
   
}


?>
