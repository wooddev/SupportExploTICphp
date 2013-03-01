<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\PlanningBundle\Entity\Jour
 */
class Jour
{
    /**
     * @var integer $id
     */
    private $id;



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
     * @var string $statutDate
     */
    private $statutDate;

    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;

    
    /*
     * Constructeur
     * __construct
     * 
     * @param DateTime $jour, Mat/ApM $creneau
     */
    
    public function __construct(/*\DateTime $jour,$creneau*/) {
//        switch($creneau){
//            case 'Mat':
//                $this->creneauDebut = $jour->setTime(8,0,0);
//                $this->creneauFin = $jour->setTime(12,0,0);
//            case 'ApM':
//                $this->creneauDebut = $jour->setTime(14,0,0);
//                $this->creneauFin = $jour->setTime(18,0,0);
//        }
//        $this->statutDate = 'Disponible';
    }
    

    /**
     * Set statutDate
     *
     * @param string $statutDate
     * @return Jour
     */
    public function setStatutDate($statutDate)
    {
        $this->statutDate = $statutDate;
    
        return $this;
    }

    /**
     * Get statutDate
     *
     * @return string 
     */
    public function getStatutDate()
    {
        return $this->statutDate;
    }

    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return Jour
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }
    /**
     * @var \DateTime
     */
    private $creneauDebut;

    /**
     * @var \DateTime
     */
    private $creneauFin;


    /**
     * Set creneauDebut
     *
     * @param \DateTime $creneauDebut
     * @return Jour
     */
    public function setCreneauDebut($creneauDebut)
    {
        $this->creneauDebut = $creneauDebut;
    
        return $this;
    }

    /**
     * Get creneauDebut
     *
     * @return \DateTime 
     */
    public function getCreneauDebut()
    {
        return $this->creneauDebut;
    }

    /**
     * Set creneauFin
     *
     * @param \DateTime $creneauFin
     * @return Jour
     */
    public function setCreneauFin($creneauFin)
    {
        $this->creneauFin = $creneauFin;
    
        return $this;
    }

    /**
     * Get creneauFin
     *
     * @return \DateTime 
     */
    public function getCreneauFin()
    {
        return $this->creneauFin;
    }
    
    /**
     * @var string
     */
    private $creneau;


    /**
     * Set creneau
     *
     * @param string $creneau
     * @return Jour
     */
    public function setCreneau($creneau)
    {
        $this->creneau = $creneau;
    
        return $this;
    }

    /**
     * Get creneau
     *
     * @return string 
     */
    public function getCreneau()
    {
        return $this->creneau;
    }
}