<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionHasStagiaire
 */
class InterventionHasStagiaire
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
     * @var \Explotic\TiersBundle\Entity\Stagiaire
     */
    private $stagiaire;

    /**
     * @var \Explotic\PlanningBundle\Entity\SessionHasIntervention
     */
    private $sessionHasIntervention;


    /**
     * Set stagiaire
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaire
     * @return InterventionHasStagiaire
     */
    public function setStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaire = null)
    {
        $this->stagiaire = $stagiaire;
    
        return $this;
    }

    /**
     * Get stagiaire
     *
     * @return \Explotic\TiersBundle\Entity\Stagiaire 
     */
    public function getStagiaire()
    {
        return $this->stagiaire;
    }

    /**
     * Set sessionHasIntervention
     *
     * @param \Explotic\PlanningBundle\Entity\SessionHasIntervention $sessionHasIntervention
     * @return InterventionHasStagiaire
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