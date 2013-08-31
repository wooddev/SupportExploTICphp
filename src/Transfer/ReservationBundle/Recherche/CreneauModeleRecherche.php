<?php
namespace Transfer\ReservationBundle\Recherche;
use Doctrine\Common\Collections\ArrayCollection;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreneauModeleRecherche
 *
 * @author adrien
 */
class CreneauModeleRecherche {
    private $jours,
            $heureDebut,
            $heureFin,
            $postes;
    
    public function __construct() {   
        $this->postes = new ArrayCollection();
    }
    
    public function getJours() {
        return $this->jours;
    }

    public function setJours($jours) {
        $this->jours = $jours;
    }
//    public function addJour($jour){
//        $this->jours[]=$jour;
//    }

    public function getHeureDebut() {
        return $this->heureDebut;
    }

    public function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;
    }

    public function getHeureFin() {
        return $this->heureFin;
    }

    public function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;
    }

    public function getPostes() {
        return $this->postes;
    }

    public function setPostes(\Transfer\ReservationBundle\Entity\TypePoste $postes) {
        $this->postes = $postes;
    }
    public function addPoste(\Transfer\ReservationBundle\Entity\TypePoste $poste){
        $this->postes->add($poste);
    }

}

?>
