<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\PlanningBundle\Entity\Jour
 */
class Jour
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $dateJour
     */
    private $dateJour;


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
     * Set dateJour
     *
     * @param \DateTime $dateJour
     * @return Jour
     */
    public function setDateJour($dateJour)
    {
        $this->dateJour = $dateJour;
    
        return $this;
    }

    /**
     * Get dateJour
     *
     * @return \DateTime 
     */
    public function getDateJour()
    {
        return $this->dateJour;
    }
    /**
     * @var string $statutDate
     */
    private $statutDate;

    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;


    /**
     * Set statutDate
     *
     * @param string $statutDate
     * @return Jour
     */
    public function setStatutDate($statutDate)
    {
        $this->statutDate = $statutDate;
    
        return $this;
    }

    /**
     * Get statutDate
     *
     * @return string 
     */
    public function getStatutDate()
    {
        return $this->statutDate;
    }

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Jour
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }
}