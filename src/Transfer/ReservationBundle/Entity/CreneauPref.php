<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreneauPref
 */
class CreneauPref
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $Disponibilite;


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
     * Set Disponibilite
     *
     * @param integer $disponibilite
     * @return CreneauPref
     */
    public function setDisponibilite($disponibilite)
    {
        $this->Disponibilite = $disponibilite;
    
        return $this;
    }

    /**
     * Get Disponibilite
     *
     * @return integer 
     */
    public function getDisponibilite()
    {
        return $this->Disponibilite;
    }
}