<?php

namespace Explotic\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 */
class Agenda
{
    /**
     * @var integer
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
    private $rdvs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rdvs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add rdvs
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $rdvs
     * @return Agenda
     */
    public function addRdv(\Explotic\AgendaBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs[] = $rdvs;
    
        return $this;
    }

    /**
     * Remove rdvs
     *
     * @param \Explotic\AgendaBundle\Entity\Rdv $rdvs
     */
    public function removeRdv(\Explotic\AgendaBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs->removeElement($rdvs);
    }

    /**
     * Get rdvs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }
    
    public function __toString() {
        return (string)$this->id;
    }
    
    
}