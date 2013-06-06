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
    private $dates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dates = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add dates
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $dates
     * @return Calendrier
     */
    public function addDate(\Explotic\AgendaBundle\Entity\Rdv $dates)
    {
        $this->dates[] = $dates;
    
        return $this;
    }

    /**
     * Remove dates
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $dates
     */
    public function removeDate(\Explotic\AgendaBundle\Entity\Rdv $dates)
    {
        $this->dates->removeElement($dates);
    }

    /**
     * Get dates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDates()
    {
        return $this->dates;
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