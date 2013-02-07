<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\PlanningBundle\Entity\Calendrier
 */
class Calendrier
{
    /**
     * @var integer $id
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $jours;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jours = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add jours
     *
     * @param Explotic\PlanningBundle\Entity\Feature $jours
     * @return Calendrier
     */
    public function addJour(\Explotic\PlanningBundle\Entity\Feature $jours)
    {
        $this->jours[] = $jours;
    
        return $this;
    }

    /**
     * Remove jours
     *
     * @param Explotic\PlanningBundle\Entity\Feature $jours
     */
    public function removeJour(\Explotic\PlanningBundle\Entity\Feature $jours)
    {
        $this->jours->removeElement($jours);
    }

    /**
     * Get jours
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getJours()
    {
        return $this->jours;
    }
}