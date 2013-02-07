<?php

namespace Explotic\FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\FormationBundle\Entity\InterventionEntreprise
 */
class InterventionEntreprise extends Intervention
{

    /**
     * @var string $stade
     */
    private $stade;

    /**
     * @var Explotic\FormationBundle\Entity\Module
     */
    private $module;


    /**
     * Set stade
     *
     * @param string $stade
     * @return InterventionEntreprise
     */
    public function setStade($stade)
    {
        $this->stade = $stade;
    
        return $this;
    }

    /**
     * Get stade
     *
     * @return string 
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * Set module
     *
     * @param Explotic\FormationBundle\Entity\Module $module
     * @return InterventionEntreprise
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
}