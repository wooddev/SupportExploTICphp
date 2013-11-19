<?php

namespace Explotic\AgendaBundle\Entity;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __construct() {
        
        $this->setDateCreation();
        $this->setDateModification();
        
        return $this;
    }
    
    
    /**
     * @var integer
     */
    protected $jour;

    /**
     * @var integer
     */
    protected $heure;

    /**
     * @var integer
     */
    protected $minute;

    /**
     * @var integer
     */
    protected $duree;

    /**
     * @var \DateTime
     */
    protected $heureDebut;

    /**
     * @var \DateTime
     */
    protected $heureFin;


    /**
     * @var \DateTime
     */
    protected $dateCreation;

    /**
     * @var \DateTime
     */
    protected $dateArchivage;

    /**
     * @var \DateTime
     */
    protected $dateModification;


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
    public function setDateArchivage()
    {
        $this->dateArchivage = new \DateTime(date('Y-m-d H:i:s'));
    
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
    
    public function getDebutInMinutes(){
        return $this->heure*60+$this->minute;
    }
}