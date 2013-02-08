<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanningConfirme
 */
class PlanningConfirme
{
    /**
     * @var integer
     */
    private $id;


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
     * @return PlanningConfirme
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