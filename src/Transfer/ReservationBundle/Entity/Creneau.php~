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
    protected $id;

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


    public function __construct() {
        
        $this->setDateCreation();
        $this->setDateModification();
        
        return $this;
    }
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
        $this->setDateModification();
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
    /**
     * @var \DateTime
     */
    private $dateCreation;

    /**
     * @var \DateTime
     */
    private $dateArchivage;

    /**
     * @var \DateTime
     */
    private $dateModification;

    /**
     * @var \Transfer\ReservationBundle\Entity\StatutCreneau
     */
    private $statut;


    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Creneau
     */
    public function setDateCreation()
    {
        $this->dateCreation = new \DateTime(date('Y-m-d H:i:s'));;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateArchivage
     *
     * @param \DateTime $dateArchivage
     * @return Creneau
     */
    public function setDateArchivage($dateArchivage)
    {
        $this->dateArchivage = $dateArchivage;
    
        return $this;
    }

    /**
     * Get dateArchivage
     *
     * @return \DateTime 
     */
    public function getDateArchivage()
    {
        return $this->dateArchivage;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return Creneau
     */
    public function setDateModification()
    {
        $this->dateModification = new \DateTime(date('Y-m-d H:i:s'));
    
        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set statut
     *
     * @param \Transfer\ReservationBundle\Entity\StatutCreneau $statut
     * @return Creneau
     */
    public function setStatut(\Transfer\ReservationBundle\Entity\StatutCreneau $statut = null)
    {
        $this->statut = $statut;
        $this->setDateModification();
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
    
    public function getDebutInMinutes(){
        return $this->heure*60+$this->minute;
    }
}