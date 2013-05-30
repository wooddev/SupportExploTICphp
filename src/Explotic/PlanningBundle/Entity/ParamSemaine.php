<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParamSemaine
 */
class ParamSemaine
{
    /**
     * @var integer
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
     * @var integer
     */
    private $jourFin;


    /**
     * Set jourFin
     *
     * @param integer $jourFin
     * @return ParamSemaine
     */
    public function setJourFin($jourFin)
    {
        $this->jourFin = $jourFin;
    
        return $this;
    }

    /**
     * Get jourFin
     *
     * @return integer 
     */
    public function getJourFin()
    {
        return $this->jourFin;
    }
}