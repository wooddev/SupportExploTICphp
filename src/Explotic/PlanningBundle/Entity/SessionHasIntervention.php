<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionHasIntervention
 */
class SessionHasIntervention
{
    /**
     * @var integer
     */
    protected $id;


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
     * @var \Explotic\PlanningBundle\Entity\Calendrier
     */
    protected $calendrier;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interventionHasStagiaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interventionHasFormateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calendrier=  new Calendrier();
    }
    
    /**
     * Set calendrier
     *
     * @param \Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return SessionHasIntervention
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return \Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }



    

    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $interventionHasStagiaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $interventionHasFormateurs;


    /**
     * Add interventionHasStagiaires
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires
     * @return SessionHasIntervention
     */
    public function addInterventionHasStagiaire(\Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires)
    {
        $this->interventionHasStagiaires->add($interventionHasStagiaires);
    
        return $this;
    }

    /**
     * Remove interventionHasStagiaires
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires
     */
    public function removeInterventionHasStagiaire(\Explotic\PlanningBundle\Entity\InterventionHasStagiaire $interventionHasStagiaires)
    {
        $this->interventionHasStagiaires->removeElement($interventionHasStagiaires);
    }

    /**
     * Get interventionHasStagiaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterventionHasStagiaires()
    {
        return $this->interventionHasStagiaires;
    }

    /**
     * Add interventionHasFormateurs
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasFormateur $interventionHasFormateurs
     * @return SessionHasIntervention
     */
    public function addInterventionHasFormateur(\Explotic\PlanningBundle\Entity\InterventionHasFormateur $interventionHasFormateurs)
    {
        $this->interventionHasFormateurs->add($interventionHasFormateurs);
    
        return $this;
    }

    /**
     * Remove interventionHasFormateurs
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasFormateur $interventionHasFormateurs
     */
    public function removeInterventionHasFormateur(\Explotic\PlanningBundle\Entity\InterventionHasFormateur $interventionHasFormateurs)
    {
        $this->interventionHasFormateurs->removeElement($interventionHasFormateurs);
    }

    /**
     * Get interventionHasFormateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterventionHasFormateurs()
    {
        return $this->interventionHasFormateurs;
    }
}