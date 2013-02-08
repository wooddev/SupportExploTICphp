<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreneauRdv
 */
class CreneauRdv extends Creneau
{
    private $semaine;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rdvs;

    /**
     * @var \Transfer\ReservationBundle\Entity\CreneauModele
     */
    private $creneauModele;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rdvs = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set creneauModele
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauModele $creneauModele
     * @return CreneauRdv
     */
    public function setCreneauModele(\Transfer\ReservationBundle\Entity\CreneauModele $creneauModele = null)
    {
        $this->creneauModele = $creneauModele;
    
        return $this;
    }

    /**
     * Get creneauModele
     *
     * @return \Transfer\ReservationBundle\Entity\CreneauModele 
     */
    public function getCreneauModele()
    {
        return $this->creneauModele;
    }
}