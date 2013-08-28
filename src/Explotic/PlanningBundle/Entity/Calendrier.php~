<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Explotic\PlanningBundle\Entity\Calendrier
 */
class Calendrier
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bookings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
    }


    
    
    public function __toString() {
        return (string)$this->id;
    }
    
    
        
    
    /**
     * @var string
     */
    private $nom;


    /**
     * Set nom
     *
     * @param string $nom
     * @return Calendrier
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
}