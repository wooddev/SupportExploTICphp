<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionHasInterventionEntreprise
 */
class SessionHasInterventionEntreprise extends SessionHasIntervention
{
   
    /**
     * @var \Explotic\FormationBundle\Entity\InterventionEntreprise
     */
    private $intervention;

    /**
     * @var \Explotic\TiersBundle\Entity\Poste
     */
    private $poste;


    /**
     * Set intervention
     *
     * @param \Explotic\FormationBundle\Entity\InterventionEntreprise $intervention
     * @return SessionHasInterventionEntreprise
     */
    public function setIntervention(\Explotic\FormationBundle\Entity\InterventionEntreprise $intervention = null)
    {
        $this->intervention = $intervention;
    
        return $this;
    }

    /**
     * Get intervention
     *
     * @return \Explotic\FormationBundle\Entity\InterventionEntreprise 
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Set poste
     *
     * @param \Explotic\TiersBundle\Entity\Poste $poste
     * @return SessionHasInterventionEntreprise
     */
    public function setPoste(\Explotic\TiersBundle\Entity\Poste $poste = null)
    {
        $this->poste = $poste;
    
        return $this;
    }

    /**
     * Get poste
     *
     * @return \Explotic\TiersBundle\Entity\Poste 
     */
    public function getPoste()
    {
        return $this->poste;
    }
    /**
     * @var \Explotic\PlanningBundle\Entity\Session
     */
    private $session;


    /**
     * Set session
     *
     * @param \Explotic\PlanningBundle\Entity\Session $session
     * @return SessionHasInterventionEntreprise
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