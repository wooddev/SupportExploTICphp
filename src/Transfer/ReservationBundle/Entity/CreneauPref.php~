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
    /**
     * @var \Transfer\ReservationBundle\Entity\CreneauModele
     */
    private $creneauModelePref;

    /**
     * @var \Transfer\ProfilBundle\Entity\Transporteur
     */
    private $transporteurPref;


    /**
     * Set creneauModelePref
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauModele $creneauModelePref
     * @return CreneauPref
     */
    public function setCreneauModelePref(\Transfer\ReservationBundle\Entity\CreneauModele $creneauModelePref = null)
    {
        $this->creneauModelePref = $creneauModelePref;
    
        return $this;
    }

    /**
     * Get creneauModelePref
     *
     * @return \Transfer\ReservationBundle\Entity\CreneauModele 
     */
    public function getCreneauModelePref()
    {
        return $this->creneauModelePref;
    }

    /**
     * Set transporteurPref
     *
     * @param \Transfer\ProfilBundle\Entity\Transporteur $transporteurPref
     * @return CreneauPref
     */
    public function setTransporteurPref(\Transfer\ProfilBundle\Entity\Transporteur $transporteurPref = null)
    {
        $this->transporteurPref = $transporteurPref;
    
        return $this;
    }

    /**
     * Get transporteurPref
     *
     * @return \Transfer\ProfilBundle\Entity\Transporteur 
     */
    public function getTransporteurPref()
    {
        return $this->transporteurPref;
    }
}