<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Machine
 */
class Machine
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $numeroEntreprise;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $modele;

    /**
     * @var string
     */
    private $marque;

    /**
     * @var string
     */
    private $logiciel;

    /**
     * @var boolean
     */
    private $transfertData;

    /**
     * @var string
     */
    private $forfait;

    /**
     * @var string
     */
    private $commentaire;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stagiaires;

    /**
     * @var \Explotic\TiersBundle\Entity\Entreprise
     */
    private $entreprise;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numeroEntreprise
     *
     * @param integer $numeroEntreprise
     * @return Machine
     */
    public function setNumeroEntreprise($numeroEntreprise)
    {
        $this->numeroEntreprise = $numeroEntreprise;
    
        return $this;
    }

    /**
     * Get numeroEntreprise
     *
     * @return integer 
     */
    public function getNumeroEntreprise()
    {
        return $this->numeroEntreprise;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Machine
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    
        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set modele
     *
     * @param string $modele
     * @return Machine
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    
        return $this;
    }

    /**
     * Get modele
     *
     * @return string 
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set marque
     *
     * @param string $marque
     * @return Machine
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    
        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set logiciel
     *
     * @param string $logiciel
     * @return Machine
     */
    public function setLogiciel($logiciel)
    {
        $this->logiciel = $logiciel;
    
        return $this;
    }

    /**
     * Get logiciel
     *
     * @return string 
     */
    public function getLogiciel()
    {
        return $this->logiciel;
    }

    /**
     * Set transfertData
     *
     * @param boolean $transfertData
     * @return Machine
     */
    public function setTransfertData($transfertData)
    {
        $this->transfertData = $transfertData;
    
        return $this;
    }

    /**
     * Get transfertData
     *
     * @return boolean 
     */
    public function getTransfertData()
    {
        return $this->transfertData;
    }

    /**
     * Set forfait
     *
     * @param string $forfait
     * @return Machine
     */
    public function setForfait($forfait)
    {
        $this->forfait = $forfait;
    
        return $this;
    }

    /**
     * Get forfait
     *
     * @return string 
     */
    public function getForfait()
    {
        return $this->forfait;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Machine
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Machine
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

    /**
     * Add stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaires
     * @return Machine
     */
    public function addStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaires)
    {
        $this->stagiaires[] = $stagiaires;
    
        return $this;
    }

    /**
     * Remove stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaires
     */
    public function removeStagiaire(\Explotic\TiersBundle\Entity\Stagiaire $stagiaires)
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
     * Set entreprise
     *
     * @param \Explotic\TiersBundle\Entity\Entreprise $entreprise
     * @return Machine
     */
    public function setEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;
    
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \Explotic\TiersBundle\Entity\Entreprise 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
    
    public function __toString(){
        return 'N°'.$this->numeroEntreprise.' '.$this->marque.' '.$this->modele;
    }
    public function setStagiaires(\Doctrine\Common\Collections\Collection $stagiaires) {
        $this->stagiaires = $stagiaires;
    }


}