<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 
use Doctrine\Common\Collections\Criteria;

/**
 * CreneauModele
 */
class CreneauModele extends Creneau
{
        
    public function init($disponibiliteTotale, $jour, $heure,
            $minute,$duree,
            \Transfer\ReservationBundle\Entity\TypePoste $typePoste
            ) 
    {    
        $this->setDisponibiliteTotale($disponibiliteTotale);
        $this->setJour($jour);
        $this->setHeure($heure);    
        $this->setMinute($minute);
        $this->setDuree($duree);
        
        $this->setTypePoste($typePoste);            
        
        $this->setHeureDebut(new \DateTime);

        $this->getHeureDebut()->setISODate(2000,1,$jour);
        $this->getHeureDebut()->setTime($heure, $minute, 0);

        $this->setHeureFin(clone $this->getHeureDebut());        
        //ajout de la durée du créneau à heurefin
        //(utilisation des fonctions natives de php sur les objets DateTime)
        $this->getHeureFin()->add(\DateInterval::createFromDateString($duree.' minutes'));
        
        return $this;
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
    
    public function getSelectable(){
        
        $criteria = Criteria::create()
                       ->where(Criteria::expr()->eq("statut",1)); 
        
        if ($this->creneauxPrefs->matching($criteria)->count()==0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function getNbReservation(TypeCamion $typeCamion){
        $criteria = Criteria::create()
                            ->Where(Criteria::expr()
                                ->eq("typeCamion",$typeCamion));           
        return $this->getCreneauxPrefs()->matching($criteria)->count();           
    }
}