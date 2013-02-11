<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Entreprise
 */
class Entreprise
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $raisonSociale
     */
    private $raisonSociale;

    /**
     * @var string $telephone
     */
    private $telephone;

    /**
     * @var Explotic\TiersBundle\Entity\Bureau
     */
    private $bureau;

    /**
     * @var Explotic\PlanningBundle\Entity\CreditTemps
     */
    private $creditTemps;


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
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Entreprise
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Entreprise
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
     * Set bureau
     *
     * @param Explotic\TiersBundle\Entity\Bureau $bureau
     * @return Entreprise
     */
    public function setBureau(\Explotic\TiersBundle\Entity\Bureau $bureau = null)
    {
        $this->bureau = $bureau;
    
        return $this;
    }

    /**
     * Get bureau
     *
     * @return Explotic\TiersBundle\Entity\Bureau 
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * Set creditTemps
     *
     * @param Explotic\PlanningBundle\Entity\CreditTemps $creditTemps
     * @return Entreprise
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
    
    public function __toString() {
        return $this->getRaisonSociale().' ('.$this->getBureau()->getLocalisation()->getCommune().')';
    }
    /**
     * @var string
     */
    private $siret;

    /**
     * @var string
     */
    private $ape;

    /**
     * @var string
     */
    private $cnil;

    /**
     * @var string
     */
    private $versionExplotic;

    /**
     * @var string
     */
    private $commentaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stagiaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $machines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->machines = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set siret
     *
     * @param string $siret
     * @return Entreprise
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set ape
     *
     * @param string $ape
     * @return Entreprise
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
    
        return $this;
    }

    /**
     * Get ape
     *
     * @return string 
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set cnil
     *
     * @param string $cnil
     * @return Entreprise
     */
    public function setCnil($cnil)
    {
        $this->cnil = $cnil;
    
        return $this;
    }

    /**
     * Get cnil
     *
     * @return string 
     */
    public function getCnil()
    {
        return $this->cnil;
    }

    /**
     * Set versionExplotic
     *
     * @param string $versionExplotic
     * @return Entreprise
     */
    public function setVersionExplotic($versionExplotic)
    {
        $this->versionExplotic = $versionExplotic;
    
        return $this;
    }

    /**
     * Get versionExplotic
     *
     * @return string 
     */
    public function getVersionExplotic()
    {
        return $this->versionExplotic;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Entreprise
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\stagiaire $stagiaires
     * @return Entreprise
     */
    public function addStagiaire(\Explotic\TiersBundle\Entity\stagiaire $stagiaires)
    {
        $this->stagiaires[] = $stagiaires;
    
        return $this;
    }

    /**
     * Remove stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\stagiaire $stagiaires
     */
    public function removeStagiaire(\Explotic\TiersBundle\Entity\stagiaire $stagiaires)
    {
        $this->stagiaires->removeElement($stagiaires);
    }

    /**
     * Get stagiaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    /**
     * Add machines
     *
     * @param \Explotic\TiersBundle\Entity\Machine $machines
     * @return Entreprise
     */
    public function addMachine(\Explotic\TiersBundle\Entity\Machine $machines)
    {
        $this->machines[] = $machines;
    
        return $this;
    }

    /**
     * Remove machines
     *
     * @param \Explotic\TiersBundle\Entity\Machine $machines
     */
    public function removeMachine(\Explotic\TiersBundle\Entity\Machine $machines)
    {
        $this->machines->removeElement($machines);
    }

    /**
     * Get machines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMachines()
    {
        return $this->machines;
    }
}