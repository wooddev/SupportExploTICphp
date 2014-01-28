<?php

namespace Explotic\FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\FormationBundle\Entity\Programme
 */
class Programme
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
     * @var string $accompagnement
     */
    private $accompagnement;

    /**
     * @var string $FormationSalle
     */
    private $FormationSalle;

    /**
     * @var Explotic\FormationBundle\Entity\Module
     */
    private $module;

    /**
     * @var Explotic\TiersBundle\Entity\Stagiaire
     */
    private $stagiaire;


    /**
     * Set accompagnement
     *
     * @param string $accompagnement
     * @return Programme
     */
    public function setAccompagnement($accompagnement)
    {
        $this->accompagnement = $accompagnement;
    
        return $this;
    }

    /**
     * Get accompagnement
     *
     * @return string 
     */
    public function getAccompagnement()
    {
        return $this->accompagnement;
    }

    /**
     * Set FormationSalle
     *
     * @param string $formationSalle
     * @return Programme
     */
    public function setFormationSalle($formationSalle)
    {
        $this->FormationSalle = $formationSalle;
    
        return $this;
    }

    /**
     * Get FormationSalle
     *
     * @return string 
     */
    public function getFormationSalle()
    {
        return $this->FormationSalle;
    }

    /**
     * Set module
     *
     * @param Explotic\FormationBundle\Entity\Module $module
     * @return Programme
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

    /**
     * Set stagiaire
     *
     * @param Explotic\TiersBundle\Entity\Stagiaire $stagiaire
     * @return Programme
     */
    public function setStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaire = null)
    {
        $this->stagiaire = $stagiaire;
    
        return $this;
    }

    /**
     * Get stagiaire
     *
     * @return Explotic\TiersBundle\Entity\Stagiaire 
     */
    public function getStagiaire()
    {
        return $this->stagiaire;
    }
    
    public function __construct() {
        $this->accompagnement='nonRealise';
        $this->FormationSalle='nonRealise';
    }
}