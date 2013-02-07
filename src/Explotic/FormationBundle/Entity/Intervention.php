<?php

namespace Explotic\FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\FormationBundle\Entity\Intervention
 */
class Intervention
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var float $dureeJour
     */
    private $dureeJour;


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
     * Set nom
     *
     * @param string $nom
     * @return Intervention
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dureeJour
     *
     * @param float $dureeJour
     * @return Intervention
     */
    public function setDureeJour($dureeJour)
    {
        $this->dureeJour = $dureeJour;
    
        return $this;
    }

    /**
     * Get dureeJour
     *
     * @return float 
     */
    public function getDureeJour()
    {
        return $this->dureeJour;
    }
}