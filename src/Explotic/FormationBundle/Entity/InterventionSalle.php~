<?php

namespace Explotic\FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\FormationBundle\Entity\InterventionSalle
 */
class InterventionSalle extends Intervention
{

    
    /**
     * @var boolean $simulateur
     */
    private $simulateur;

    /**
     * @var integer $stade
     */
    private $stade;

    /**
     * @var Explotic\FormationBundle\Entity\Module
     */
    private $module;


    /**
     * Set simulateur
     *
     * @param boolean $simulateur
     * @return InterventionSalle
     */
    public function setSimulateur($simulateur)
    {
        $this->simulateur = $simulateur;
    
        return $this;
    }

    /**
     * Get simulateur
     *
     * @return boolean 
     */
    public function getSimulateur()
    {
        return $this->simulateur;
    }

    /**
     * Set stade
     *
     * @param integer $stade
     * @return InterventionSalle
     */
    public function setStade($stade)
    {
        $this->stade = $stade;
    
        return $this;
    }

    /**
     * Get stade
     *
     * @return integer 
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * Set module
     *
     * @param Explotic\FormationBundle\Entity\Module $module
     * @return InterventionSalle
     */
    public function setModule(\Explotic\FormationBundle\Entity\Module $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return Explotic\FormationBundle\Entity\Module 
     */
    public function getModule()
    {
        return $this->module;
    }
     
    public function __toString() {
        return $this->getNom().'/ étape : '.$this->getStade();
    }
}