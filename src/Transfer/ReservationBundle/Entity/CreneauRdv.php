<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 

/**
 * CreneauRdv
 */
class CreneauRdv extends Creneau
{   
    
    /**
     * @var integer
     */
    private $semaine;

    /**
     * @var integer
     */
    private $annee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rdvs;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->rdvs = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    /**
     * Set semaine
     *
     * @param integer $semaine
     * @return CreneauRdv
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;
    
        return $this;
    }

    /**
     * Get semaine
     *
     * @return integer 
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     * @return CreneauRdv
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Add rdvs
     *
     * @param \Transfer\ReservationBundle\Entity\Rdv $rdvs
     * @return CreneauRdv
     */
    public function addRdv(\Transfer\ReservationBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs[] = $rdvs;
    
        return $this;
    }

    /**
     * Remove rdvs
     *
     * @param \Transfer\ReservationBundle\Entity\Rdv $rdvs
     */
    public function removeRdv(\Transfer\ReservationBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs->removeElement($rdvs);
    }

    /**
     * Get rdvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }
 
    
    public function calculDateTime(){
        $this->setHeureDebut(new \DateTime);
        
        $this->getHeureDebut()->setISODate($this->getAnnee(),$this->getSemaine(),$this->getJour());
        $this->getHeureDebut()->setTime($this->getHeure(), $this->getMinute(), 0);

        $this->setHeureFin(clone $this->getHeureDebut());        
        //ajout de la durée du créneau à heurefin
        //(utilisation des fonctions natives de php sur les objets DateTime)
        $this->getHeureFin()->add(\DateInterval::createFromDateString($this->getDuree().' minutes'));
    }
}