<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Organisme
 */
class Organisme
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
     * @return Organisme
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $formateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->formateur = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add formateur
     *
     * @param \Explotic\TiersBundle\Entity\Formateur $formateur
     * @return Organisme
     */
    public function addFormateur(\Explotic\TiersBundle\Entity\Formateur $formateur)
    {
        $this->formateur[] = $formateur;
    
        return $this;
    }

    /**
     * Remove formateur
     *
     * @param \Explotic\TiersBundle\Entity\Formateur $formateur
     */
    public function removeFormateur(\Explotic\TiersBundle\Entity\Formateur $formateur)
    {
        $this->formateur->removeElement($formateur);
    }

    /**
     * Get formateur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormateur()
    {
        return $this->formateur;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $salles;


    /**
     * Add salles
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salles
     * @return Organisme
     */
    public function addSalle(\Explotic\TiersBundle\Entity\Salle $salles)
    {
        $this->salles[] = $salles;
    
        return $this;
    }

    /**
     * Remove salles
     *
     * @param \Explotic\TiersBundle\Entity\Salle $salles
     */
    public function removeSalle(\Explotic\TiersBundle\Entity\Salle $salles)
    {
        $this->salles->removeElement($salles);
    }

    /**
     * Get salles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalles()
    {
        return $this->salles;
    }
    
    public function setFormateur(\Doctrine\Common\Collections\Collection $formateur) {
        $this->formateur = $formateur;
    }

    public function setSalles(\Doctrine\Common\Collections\Collection $salles) {
        $this->salles = $salles;
    }


}