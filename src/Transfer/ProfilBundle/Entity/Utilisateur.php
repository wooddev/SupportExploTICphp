<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 */
class Utilisateur
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
     * @var string
     */
    private $courriel;

    /**
     * @var string
     */
    private $telephone;


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
     * @return Utilisateur
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
     * @return Utilisateur
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
     * Set courriel
     *
     * @param string $courriel
     * @return Utilisateur
     */
    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;
    
        return $this;
    }

    /**
     * Get courriel
     *
     * @return string 
     */
    public function getCourriel()
    {
        return $this->courriel;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Utilisateur
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
     * @var datetime
     */
    private $dateEnregistrement;


    /**
     * Set dateEnregistrement
     *
     * @param \datetime $dateEnregistrement
     * @return Utilisateur
     */
    public function setDateEnregistrement(\datetime $dateEnregistrement)
    {
        $this->dateEnregistrement = $dateEnregistrement;
    
        return $this;
    }

    /**
     * Get dateEnregistrement
     *
     * @return \datetime 
     */
    public function getDateEnregistrement()
    {
        return $this->dateEnregistrement;
    }
}