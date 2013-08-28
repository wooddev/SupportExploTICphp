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

    /**
     * Add bookings
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $bookings
     * @return Calendrier
     */
    public function addBooking(\Explotic\AgendaBundle\Entity\Rdv $bookings)
    {
        $this->bookings[] = $bookings;
    
        return $this;
    }

    /**
     * Remove bookings
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $bookings
     */
    public function removeBooking(\Explotic\AgendaBundle\Entity\Rdv $bookings)
    {
        $this->bookings->removeElement($bookings);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}