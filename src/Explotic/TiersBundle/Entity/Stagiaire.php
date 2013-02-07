<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Stagiaire
 */
class Stagiaire
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
     * @var \DateTime $dateNaissance
     */
    private $dateNaissance;

    /**
     * @var boolean $marchePiedInfo
     */
    private $marchePiedInfo;

    /**
     * @var string $telephone
     */
    private $telephone;

    /**
     * @var string $opca
     */
    private $opca;

    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    /**
     * @var Explotic\PlanningBundle\Entity\CreditTemps
     */
    private $creditTemps;

    /**
     * @var Explotic\TiersBundle\Entity\Entreprise
     */
    private $entreprise;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $sessions;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $postes;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->postes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Stagiaire
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
     * @return Stagiaire
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
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Stagiaire
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    
        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set marchePiedInfo
     *
     * @param boolean $marchePiedInfo
     * @return Stagiaire
     */
    public function setMarchePiedInfo($marchePiedInfo)
    {
        $this->marchePiedInfo = $marchePiedInfo;
    
        return $this;
    }

    /**
     * Get marchePiedInfo
     *
     * @return boolean 
     */
    public function getMarchePiedInfo()
    {
        return $this->marchePiedInfo;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Stagiaire
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set opca
     *
     * @param string $opca
     * @return Stagiaire
     */
    public function setOpca($opca)
    {
        $this->opca = $opca;
    
        return $this;
    }

    /**
     * Get opca
     *
     * @return string 
     */
    public function getOpca()
    {
        return $this->opca;
    }

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Stagiaire
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
     * Set creditTemps
     *
     * @param Explotic\PlanningBundle\Entity\CreditTemps $creditTemps
     * @return Stagiaire
     */
    public function setCreditTemps(\Explotic\PlanningBundle\Entity\CreditTemps $creditTemps = null)
    {
        $this->creditTemps = $creditTemps;
    
        return $this;
    }

    /**
     * Get creditTemps
     *
     * @return Explotic\PlanningBundle\Entity\CreditTemps 
     */
    public function getCreditTemps()
    {
        return $this->creditTemps;
    }

    /**
     * Set entreprise
     *
     * @param Explotic\TiersBundle\Entity\Entreprise $entreprise
     * @return Stagiaire
     */
    public function setEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;
    
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return Explotic\TiersBundle\Entity\Entreprise 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Add sessions
     *
     * @param Explotic\PlanningBundle\Entity\Session $sessions
     * @return Stagiaire
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
     * Add postes
     *
     * @param \Explotic\TiersBundle\Entity\Poste $postes
     * @return Stagiaire
     */
    public function addPoste(\Explotic\TiersBundle\Entity\Poste $postes)
    {
        $this->postes[] = $postes;
    
        return $this;
    }

    /**
     * Remove postes
     *
     * @param \Explotic\TiersBundle\Entity\Poste $postes
     */
    public function removePoste(\Explotic\TiersBundle\Entity\Poste $postes)
    {
        $this->postes->removeElement($postes);
    }

    /**
     * Get postes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostes()
    {
        return $this->postes;
    }

    /*
     *  __toString
     * 
     * Affichage sous forme de string de la classe
     * 
     * @return string
     */
    
    public function __toString()
    {
        return $this->prenom.' '.$this->nom;
    }
    
}