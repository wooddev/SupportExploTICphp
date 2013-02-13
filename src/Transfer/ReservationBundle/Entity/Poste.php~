<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 */
class Poste
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $disponibilite;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set disponibilite
     *
     * @param integer $disponibilite
     * @return Poste
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    
        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return integer 
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }
    /**
     * @var \Transfer\ReservationBundle\Entity\TypePoste
     */
    private $typePoste;


    /**
     * Set typePoste
     *
     * @param \Transfer\ReservationBundle\Entity\TypePoste $typePoste
     * @return Poste
     */
    public function setTypePoste(\Transfer\ReservationBundle\Entity\TypePoste $typePoste = null)
    {
        $this->typePoste = $typePoste;
    
        return $this;
    }

    /**
     * Get typePoste
     *
     * @return \Transfer\ReservationBundle\Entity\TypePoste 
     */
    public function getTypePoste()
    {
        return $this->typePoste;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rdvs;

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
     * @return Poste
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
}