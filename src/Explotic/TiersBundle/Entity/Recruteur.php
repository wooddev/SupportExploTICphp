<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recruteur
 */
class Recruteur extends \Explotic\AdminBundle\Entity\User
{
  
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stagiaires;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stagiaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entreprises = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add stagiaires
     *
     * @param \Explotic\TiersBundle\Entity\Stagiaire $stagiaires
     * @return Recruteur
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
     * @var \Explotic\TiersBundle\Entity\Entreprise
     */
    private $employeur;


    /**
     * Set employeur
     *
     * @param \Explotic\TiersBundle\Entity\Entreprise $employeur
     * @return Recruteur
     */
    public function setEmployeur(\Explotic\TiersBundle\Entity\Entreprise $employeur = null)
    {
        $this->employeur = $employeur;
    
        return $this;
    }

    /**
     * Get employeur
     *
     * @return \Explotic\TiersBundle\Entity\Entreprise 
     */
    public function getEmployeur()
    {
        return $this->employeur;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $entreprises;


    /**
     * Add entreprises
     *
     * @param \Explotic\TiersBundle\Entity\Entreprise $entreprises
     * @return Recruteur
     */
    public function addEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprises)
    {
        $this->entreprises[] = $entreprises;
    
        return $this;
    }

    /**
     * Remove entreprises
     *
     * @param \Explotic\TiersBundle\Entity\Entreprise $entreprises
     */
    public function removeEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprises)
    {
        $this->entreprises->removeElement($entreprises);
    }

    /**
     * Get entreprises
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntreprises()
    {
        return $this->entreprises;
    }       


}