<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recruteur
 */
class Recruteur
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
     * @var string
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
     * @return Recruteur
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
     * @return Recruteur
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
        $this->comptes = new \Doctrine\Common\Collections\ArrayCollection();
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
       
    public function __toString()
    {
        return $this->getPrenom().' '.$this->getNom();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comptes;


    /**
     * Add comptes
     *
     * @param \Explotic\AdminBundle\Entity\User $comptes
     * @return Recruteur
     */
    public function addCompte(\Explotic\AdminBundle\Entity\User $comptes)
    {
        $this->comptes[] = $comptes;
    
        return $this;
    }

    /**
     * Remove comptes
     *
     * @param \Explotic\AdminBundle\Entity\User $comptes
     */
    public function removeCompte(\Explotic\AdminBundle\Entity\User $comptes)
    {
        $this->comptes->removeElement($comptes);
    }

    /**
     * Get comptes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComptes()
    {
        return $this->comptes;
    }
}