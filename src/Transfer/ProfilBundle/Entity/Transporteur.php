<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporteur
 */
class Transporteur
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
     * @var integer
     */
    private $priorite;

    /**
     * @var integer
     */
    private $quota;

    
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
     * @return Transporteur
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
     * Set priorite
     *
     * @param integer $priorite
     * @return Transporteur
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;
    
        return $this;
    }

    /**
     * Get priorite
     *
     * @return integer 
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * Set quota
     *
     * @param integer $quota
     * @return Transporteur
     */
    public function setQuota($quota)
    {
        $this->quota = $quota;
    
        return $this;
    }

    /**
     * Get quota
     *
     * @return integer 
     */
    public function getQuota()
    {
        return $this->quota;
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



    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $agentTrsps;


    /**
     * Add agentTrsps
     *
     * @param \Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsps
     * @return Transporteur
     */
    public function addAgentTrsp(\Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsps)
    {
        $this->agentTrsps[] = $agentTrsps;
    
        return $this;
    }

    /**
     * Remove agentTrsps
     *
     * @param \Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsps
     */
    public function removeAgentTrsp(\Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsps)
    {
        $this->agentTrsps->removeElement($agentTrsps);
    }

    /**
     * Get agentTrsps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAgentTrsps()
    {
        return $this->agentTrsps;
    }
    
    public function __toString() {
        return $this->getId().'  '.$this->getNom();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $creneauPrefs;


    /**
     * Add creneauPrefs
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauPref $creneauPrefs
     * @return Transporteur
     */
    public function addCreneauPref(\Transfer\ReservationBundle\Entity\CreneauPref $creneauPrefs)
    {
        $this->creneauPrefs[] = $creneauPrefs;
    
        return $this;
    }

    /**
     * Remove creneauPrefs
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauPref $creneauPrefs
     */
    public function removeCreneauPref(\Transfer\ReservationBundle\Entity\CreneauPref $creneauPrefs)
    {
        $this->creneauPrefs->removeElement($creneauPrefs);
    }

    /**
     * Get creneauPrefs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreneauPrefs()
    {
        return $this->creneauPrefs;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $evenements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentTrsps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauPrefs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add evenements
     *
     * @param \Transfer\ReservationBundle\Entity\Evenement $evenements
     * @return Transporteur
     */
    public function addEvenement(\Transfer\ReservationBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;
    
        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \Transfer\ReservationBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\Transfer\ReservationBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->evenements;
    }
}