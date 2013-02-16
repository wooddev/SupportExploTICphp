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
    /*
     * Constructeur de la classe
     * Permet de transmettre les paramètres 
     */
    
    
    public function __construct($_heureDebut,$_minDebut, $_minFin,
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
    
    /*
     * Méthode Générator :
     * Permet de générer les modèles de créneaux sur une semaine
     * à partir des propriétés du générateur
     */
    
    public function generate() {
        
        $minDebutTot = $this->heureDebut*60+$this->minDebut;
        $minFinTot =$this->heureFin*60+$this->minFin;
        
//        $duree = $minFinTot-$minDebutTot;
//        $nbCreneau = ceil($duree/$this->pasDeTemps);
                
        for ($i = 1; $i <= 6; $i++) {
            for ($min = $minDebutTot; $min <=$minFinTot; $min=$min+$this->pasDeTemps){
//                $creneau= new CreneauModele(       
//                        $this->disponibilite,                           //disponibilite
//                        $i,                                             //jour
//                        floor($min/60),                                 //heure
//                        $min-floor($min/60)*60,                         //min 
//                        $this->pasDeTemps,                              //durée
//                        $this->typePoste);  
                $this->CreneauxModeles->add(new CreneauModele(       
                        $this->disponibilite,                           //disponibilite
                        $i,                                             //jour
                        floor($min/60),                                 //heure
                        $min-floor($min/60)*60,                         //min 
                        $this->pasDeTemps,                              //durée
                        $this->typePoste));                             //poste
            }
        }    
        
    }
      
      
    
}

?>
