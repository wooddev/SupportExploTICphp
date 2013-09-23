<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Formateur
 */
class Formateur extends \Explotic\AdminBundle\Entity\User
{
    
    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Formateur
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $sessions;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_FORMATEUR');
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calendrier = new \Explotic\PlanningBundle\Entity\Calendrier();

    }
    
    /**
     * Add sessions
     *
     * @param Explotic\PlanningBundle\Entity\Session $sessions
     * @return Formateur
     */
    public function addSession(\Explotic\PlanningBundle\Entity\Session $sessions)
    {
        $this->sessions[] = $sessions;
    
        return $this;
    }

    /**
     * Remove sessions
     *
     * @param Explotic\PlanningBundle\Entity\Session $sessions
     */
    public function removeSession(\Explotic\PlanningBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }
    
    /**
     * Get sessions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSessions()
    {
        return $this->sessions;
    }
    
    
    public function __toString() {
        return $this->prenom.' '.$this->nom;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
   
    /**
     * @var \Explotic\TiersBundle\Entity\Organisme
     */
    private $organisme;



    /**
     * Set organisme
     *
     * @param \Explotic\TiersBundle\Entity\Organisme $organisme
     * @return Formateur
     */
    public function setOrganisme(\Explotic\TiersBundle\Entity\Organisme $organisme = null)
    {
        $this->organisme = $organisme;
    
        return $this;
    }

    /**
     * Get organisme
     *
     * @return \Explotic\TiersBundle\Entity\Organisme 
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }
    
    public function setSessions(\Doctrine\Common\Collections\ArrayCollection $sessions) {
        $this->sessions = $sessions;
    }


}