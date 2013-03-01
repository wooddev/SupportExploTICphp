<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Explotic\PlanningBundle\Entity\Jour as Jour;

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

    /**
     * @var \Doctrine\Common\Collections\Collection
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
     * @param \Explotic\PlanningBundle\Entity\Jour $jours
     * @return Calendrier
     */
    public function addJour(\Explotic\PlanningBundle\Entity\Jour $jour)
    {
        $this->jours[] = $jour;
    
        return $this;
    }
    /**
     * Add New jour
     *
     * @param \DateTime $date, Mat/Apm $creneau
     * @return Calendrier
     */
    public function addNewJour($date, $creneau)
    {
        $jour = new \Jour($date, $creneau);
        $jour->setCalendrier($this);
        $this->jours->Add($jour);
    
        return $this;
    }

    /**
     * Remove jours
     *
     * @param \Explotic\PlanningBundle\Entity\Jour $jours
     */
    public function removeJour(\Explotic\PlanningBundle\Entity\Jour $jours)
    {
        $this->jours->removeElement($jours);
    }

    /**
     * Get jours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJours()
    {
        return $this->jours;
    }
    
    public function __toString(){
        return strval($this->id);
    }
}