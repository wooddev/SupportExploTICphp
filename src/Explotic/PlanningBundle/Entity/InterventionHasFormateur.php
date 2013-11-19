<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionHasFormateur
 */
class InterventionHasFormateur
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
     * @var \Explotic\TiersBundle\Entity\Formateur
     */
    private $formateur;

    /**
     * @var \Explotic\PlanningBundle\Entity\SessionHasIntervention
     */
    private $sessionHasIntervention;


    /**
     * Set formateurs
     *
     * @param \Explotic\TiersBundle\Entity\Formateur $formateur
     * @return InterventionHasFormateur
     */
    public function setFormateur(\Explotic\TiersBundle\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;
    
        return $this;
    }

    /**
     * Get formateur
     *
     * @return \Explotic\TiersBundle\Entity\Formateur 
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Set sessionHasIntervention
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasIntervention $sessionHasIntervention
     * @return InterventionHasFormateur
     */
    public function setSessionHasIntervention(\Explotic\PlanningBundle\Entity\SessionHasIntervention $sessionHasIntervention = null)
    {
        $this->sessionHasIntervention = $sessionHasIntervention;
    
        return $this;
    }

    /**
     * Get sessionHasIntervention
     *
     * @return \Explotic\PlanningBundle\Entity\SessionHasIntervention 
     */
    public function getSessionHasIntervention()
    {
        return $this->sessionHasIntervention;
    }    

}