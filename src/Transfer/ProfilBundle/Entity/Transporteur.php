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
     * Add rdvs
     *
     * @param \Transfer\ReservationBundle\Entity\Rdv $rdvs
     * @return Transporteur
     */
    public function addRdv(\Transfer\ReservationBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs[] = $rdvs;
    
        return $this;
    }

    /**
     * Remove rdvs
     *
     * @param \Transfer\ReservationBundle\Entity\Rdv $rdvs
     */
    public function removeRdv(\Transfer\ReservationBundle\Entity\Rdv $rdvs)
    {
        $this->rdvs->removeElement($rdvs);
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
}