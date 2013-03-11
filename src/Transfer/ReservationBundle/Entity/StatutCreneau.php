<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutCreneau
 */
class StatutCreneau
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;


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
     * @return StatutCreneau
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
     * Transform to String
     * 
     * @return string
     */
    
    public function __toString() {
        return $this->getNom();
    }
}