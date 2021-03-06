<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionHasInterventionSalle
 */
class SessionHasInterventionSalle extends SessionHasIntervention
{
   
    /**
     * @var \Explotic\FormationBundle\Entity\InterventionSalle
     */
    private $intervention;

    /**
     * @var \Explotic\TiersBundle\Entity\Salle
     */
    private $salle;


    /**
     * Set intervention
     *
     * @param \Explotic\FormationBundle\Entity\InterventionSalle $intervention
     * @return SessionHasInterventionSalle
     */
    public function setIntervention(\Explotic\FormationBundle\Entity\InterventionSalle $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Explotic\FormationBundle\Entity\InterventionSalle 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set salle
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salle
     * @return SessionHasInterventionSalle
     */
    public function setSalle(\Explotic\TiersBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;
    
        return $this;
    }

    /**
     * Get salle
     *
     * @return \Explotic\TiersBundle\Entity\Salle 
     */
    public function getSalle()
    {
        return $this->salle;
    }
    /**
     * @var \Explotic\PlanningBundle\Entity\Session
     */
    private $session;


    /**
     * Set session
     *
     * @param \Explotic\PlanningBundle\Entity\Session $session
     * @return SessionHasInterventionSalle
     */
    public function setSession(\Explotic\PlanningBundle\Entity\Session $session = null)
    {
        $this->session = $session;
    
        return $this;
    }

    /**
     * Get session
     *
     * @return \Explotic\PlanningBundle\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }
}