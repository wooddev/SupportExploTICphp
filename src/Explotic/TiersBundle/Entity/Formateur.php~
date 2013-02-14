<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Formateur
 */
class Formateur
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
     * @var string $prenom
     */
    private $prenom;


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
     * @return Formateur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Formateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    /**
     * @var Explotic\TiersBundle\Entity\Organisme
     */
    private $Organisme;


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
     * Set Organisme
     *
     * @param Explotic\TiersBundle\Entity\Organisme $organisme
     * @return Formateur
     */
    public function setOrganisme(\Explotic\TiersBundle\Entity\Organisme $organisme = null)
    {
        $this->Organisme = $organisme;
    
        return $this;
    }

    /**
     * Get Organisme
     *
     * @return Explotic\TiersBundle\Entity\Organisme 
     */
    public function getOrganisme()
    {
        return $this->Organisme;
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
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
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
    /**
     * @var \Explotic\AdminBundle\Entity\User
     */
    private $compte;


    /**
     * Set compte
     *
     * @param \Explotic\AdminBundle\Entity\User $compte
     * @return Formateur
     */
    public function setCompte(\Explotic\AdminBundle\Entity\User $compte = null)
    {
        $this->compte = $compte;
    
        return $this;
    }

    /**
     * Get compte
     *
     * @return \Explotic\AdminBundle\Entity\User 
     */
    public function getCompte()
    {
        return $this->compte;
    }
}