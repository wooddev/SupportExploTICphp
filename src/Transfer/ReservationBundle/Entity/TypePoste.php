<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePoste
 */
class TypePoste
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
    private $disponibilite;


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
     * @return TypePoste
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
     * Set disponibilite
     *
     * @param integer $disponibilite
     * @return TypePoste
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    
        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return integer 
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }
    
    public function __toString() {
        return $this->getNom();
    }    
   
}