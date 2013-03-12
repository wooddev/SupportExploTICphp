<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 

/**
 * CreneauModele
 */
class CreneauModele extends Creneau
{
        
    public function init($disponibilite, $jour, $heure,
            $minute,$duree,
            \Transfer\ReservationBundle\Entity\TypePoste $typePoste) 
    {    
        $this->setDisponibilite($disponibilite);
        $this->setJour($jour);
        $this->setHeure($heure);    
        $this->setMinute($minute);
        $this->setDuree($duree);

        $this->setTypePoste($typePoste);     
                         
        $this->setHeureDebut(new \DateTime);
        $this->setHeureFin(new \DateTime);
        
        $this->getHeureDebut()->setTime($heure, $minute, 0);
        $fin= $heure*60+$minute+$duree;
        $heureFin=floor($fin/60);
        $minuteFin=$fin-$heureFin;
        $this->getHeureFin()->setTime($heureFin,$minuteFin,0);           
    }    
    
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $creneauxPrefs;

    /**
     * Constructor
     */
        
    public function __construct() {
        parent::__construct();
        $this->creneauxPrefs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Add creneauxPrefs
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauPref $creneauxPrefs
     * @return CreneauModele
     */
    public function addCreneauxPref(\Transfer\ReservationBundle\Entity\CreneauPref $creneauxPrefs)
    {
        $this->creneauxPrefs[] = $creneauxPrefs;
    
        return $this;
    }

    /**
     * Remove creneauxPrefs
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauPref $creneauxPrefs
     */
    public function removeCreneauxPref(\Transfer\ReservationBundle\Entity\CreneauPref $creneauxPrefs)
    {
        $this->creneauxPrefs->removeElement($creneauxPrefs);
    }

    /**
     * Get creneauxPrefs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreneauxPrefs()
    {
        return $this->creneauxPrefs;
    }
    
    public function __toString() {
        return $this->getJour().'-'
                .$this->getHeure().':'
                .$this->getMinute().'-'
                .$this->getDuree().' min /'
                .$this->getTypePoste()->getNom();
    }
}