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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $employerecruteur;


    /**
     * Add employerecruteur
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employerecruteur
     * @return Entreprise
     */
    public function addEmployerecruteur(\Explotic\TiersBundle\Entity\Recruteur $employerecruteur)
    {
        $this->employerecruteur[] = $employerecruteur;
    
        return $this;
    }

    /**
     * Remove employerecruteur
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employerecruteur
     */
    public function removeEmployerecruteur(\Explotic\TiersBundle\Entity\Recruteur $employerecruteur)
    {
        $this->employerecruteur->removeElement($employerecruteur);
    }

    /**
     * Get employerecruteur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployerecruteur()
    {
        return $this->employerecruteur;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $employesrecruteurs;


    /**
     * Add employesrecruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs
     * @return Entreprise
     */
    public function addEmployesrecruteur(\Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs)
    {
        $this->employesrecruteurs[] = $employesrecruteurs;
    
        return $this;
    }

    /**
     * Remove employesrecruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs
     */
    public function removeEmployesrecruteur(\Explotic\TiersBundle\Entity\Recruteur $employesrecruteurs)
    {
        $this->employesrecruteurs->removeElement($employesrecruteurs);
    }

    /**
     * Get employesrecruteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployesrecruteurs()
    {
        return $this->employesrecruteurs;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $recruteurs;


    /**
     * Add recruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $recruteurs
     * @return Entreprise
     */
    public function addRecruteur(\Explotic\TiersBundle\Entity\Recruteur $recruteurs)
    {
        $this->recruteurs[] = $recruteurs;
    
        return $this;
    }

    /**
     * Remove recruteurs
     *
     * @param \Explotic\TiersBundle\Entity\Recruteur $recruteurs
     */
    public function removeRecruteur(\Explotic\TiersBundle\Entity\Recruteur $recruteurs)
    {
        $this->recruteurs->removeElement($recruteurs);
    }

    /**
     * Get recruteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecruteurs()
    {
        return $this->recruteurs;
    }
    /**
     * @var \Explotic\AdminBundle\Entity\User
     */
    private $compte;


    /**
     * Set compte
     *
     * @param \Explotic\AdminBundle\Entity\User $compte
     * @return Entreprise
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
    /**
     * @var string
     */
    private $email;


    /**
     * Set email
     *
     * @param string $email
     * @return Entreprise
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}