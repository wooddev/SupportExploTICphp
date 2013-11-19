<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Formateur
 */
class Formateur extends \Explotic\AdminBundle\Entity\User
{
    
    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Formateur
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



    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_FORMATEUR');        
        $this->calendrier = new \Explotic\PlanningBundle\Entity\Calendrier();
        $this->interventionHasFormateurs = new \Doctrine\Common\Collections\ArrayCollection();

    }
    

    

    
    
    public function __toString() {
        if($this->getFirstname() && $this->getLastname())
            return $this->getFirstname().' '.$this->getLastname();        
        elseif($this->username)
            return $this->username;
        else
            return '-';
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
   
    /**
     * @var \Explotic\TiersBundle\Entity\Organisme
     */
    private $organisme;



    /**
     * Set organisme
     *
     * @param \Explotic\TiersBundle\Entity\Organisme $organisme
     * @return Formateur
     */
    public function setOrganisme(\Explotic\TiersBundle\Entity\Organisme $organisme = null)
    {
        $this->organisme = $organisme;
    
        return $this;
    }

    /**
     * Get organisme
     *
     * @return \Explotic\TiersBundle\Entity\Organisme 
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }



    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $interventionHasFormateurs;


    /**
     * Add interventionHasFormateurs
     *
     * @param \Explotic\PlanningBundle\Entity\InterventionHasFormateur $interventionHasFormateurs
     * @return Formateur
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