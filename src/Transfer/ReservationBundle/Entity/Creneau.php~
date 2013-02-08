<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Creneau
 */
class Creneau
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $jour;

    /**
     * @var integer
     */
    private $heure;

    /**
     * @var integer
     */
    private $minute;

    /**
     * @var integer
     */
    private $duree;

    /**
     * @var \DateTime
     */
    private $heureDebut;

    /**
     * @var \DateTime
     */
    private $heureFin;

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
     * Set jour
     *
     * @param integer $jour
     * @return Creneau
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    
        return $this;
    }

    /**
     * Get jour
     *
     * @return integer 
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set heure
     *
     * @param integer $heure
     * @return Creneau
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    
        return $this;
    }

    /**
     * Get heure
     *
     * @return integer 
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set minute
     *
     * @param integer $minute
     * @return Creneau
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    
        return $this;
    }

    /**
     * Get minute
     *
     * @return integer 
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Creneau
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    
        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     * @return Creneau
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    
        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     * @return Creneau
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    
        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set disponibilite
     *
     * @param integer $disponibilite
     * @return Creneau
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
     * @return Creneau
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