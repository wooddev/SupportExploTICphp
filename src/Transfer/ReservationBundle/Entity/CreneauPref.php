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
     * @var \Transfer\ReservationBundle\Entity\CreneauModele
     */
    private $creneauModele;

    /**
     * @var \Transfer\ProfilBundle\Entity\Transporteur
     */
    private $transporteur;

    /**
     * @var \Transfer\ReservationBundle\Entity\EtatReservation
     */
    private $etatReservation;


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
     * Set creneauModele
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauModele $creneauModele
     * @return CreneauPref
     */
    public function setCreneauModele(\Transfer\ReservationBundle\Entity\CreneauModele $creneauModele = null)
    {
        $this->creneauModele = $creneauModele;
    
        return $this;
    }

    /**
     * Get creneauModele
     *
     * @return \Transfer\ReservationBundle\Entity\CreneauModele 
     */
    public function getCreneauModele()
    {
        return $this->creneauModele;
    }

    /**
     * Set transporteur
     *
     * @param \Transfer\ProfilBundle\Entity\Transporteur $transporteur
     * @return CreneauPref
     */
    public function setTransporteur(\Transfer\ProfilBundle\Entity\Transporteur $transporteur = null)
    {
        $this->transporteur = $transporteur;
    
        return $this;
    }

    /**
     * Get transporteur
     *
     * @return \Transfer\ProfilBundle\Entity\Transporteur 
     */
    public function getTransporteur()
    {
        return $this->transporteur;
    }

    /**
     * Set etatReservation
     *
     * @param \Transfer\ReservationBundle\Entity\EtatReservation $etatReservation
     * @return CreneauPref
     */
    public function setEtatReservation(\Transfer\ReservationBundle\Entity\EtatReservation $etatReservation = null)
    {
        $this->etatReservation = $etatReservation;
    
        return $this;
    }

    /**
     * Get etatReservation
     *
     * @return \Transfer\ReservationBundle\Entity\EtatReservation 
     */
    public function getEtatReservation()
    {
        return $this->etatReservation;
    }
    /**
     * @var \Transfer\ReservationBundle\Entity\StatutCreneau
     */
    private $statut;


    /**
     * Set statut
     *
     * @param \Transfer\ReservationBundle\Entity\StatutCreneau $statut
     * @return CreneauPref
     */
    public function setStatut(\Transfer\ReservationBundle\Entity\StatutCreneau $statut = null)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return \Transfer\ReservationBundle\Entity\StatutCreneau 
     */
    public function getStatut()
    {
        return $this->statut;
    }
    
    public function getCreneauStructure(){
        return $this->getCreneauModele();
    }    
    
}