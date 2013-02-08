<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 */
class Poste
{
    /**
     * @var integer
     */
    private $id;

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
     * Set disponibilite
     *
     * @param integer $disponibilite
     * @return Poste
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
    /**
     * @var \Transfer\ReservationBundle\Entity\TypePoste
     */
    private $typePoste;


    /**
     * Set typePoste
     *
     * @param \Transfer\ReservationBundle\Entity\TypePoste $typePoste
     * @return Poste
     */
    public function setTypePoste(\Transfer\ReservationBundle\Entity\TypePoste $typePoste = null)
    {
        $this->typePoste = $typePoste;
    
        return $this;
    }

    /**
     * Get typePoste
     *
     * @return \Transfer\ReservationBundle\Entity\TypePoste 
     */
    public function getTypePoste()
    {
        return $this->typePoste;
    }
}