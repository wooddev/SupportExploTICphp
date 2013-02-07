<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\PlanningBundle\Entity\CreditTemps
 */
class CreditTemps
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $tempsTotal
     */
    private $tempsTotal;

    /**
     * @var integer $tempsReserve
     */
    private $tempsReserve;

    /**
     * @var integer $tempsConsomme
     */
    private $tempsConsomme;

    /**
     * @var integer $tempsDisponible
     */
    private $tempsDisponible;


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
     * Set tempsTotal
     *
     * @param integer $tempsTotal
     * @return CreditTemps
     */
    public function setTempsTotal($tempsTotal)
    {
        $this->tempsTotal = $tempsTotal;
    
        return $this;
    }

    /**
     * Get tempsTotal
     *
     * @return integer 
     */
    public function getTempsTotal()
    {
        return $this->tempsTotal;
    }

    /**
     * Set tempsReserve
     *
     * @param integer $tempsReserve
     * @return CreditTemps
     */
    public function setTempsReserve($tempsReserve)
    {
        $this->tempsReserve = $tempsReserve;
    
        return $this;
    }

    /**
     * Get tempsReserve
     *
     * @return integer 
     */
    public function getTempsReserve()
    {
        return $this->tempsReserve;
    }

    /**
     * Set tempsConsomme
     *
     * @param integer $tempsConsomme
     * @return CreditTemps
     */
    public function setTempsConsomme($tempsConsomme)
    {
        $this->tempsConsomme = $tempsConsomme;
    
        return $this;
    }

    /**
     * Get tempsConsomme
     *
     * @return integer 
     */
    public function getTempsConsomme()
    {
        return $this->tempsConsomme;
    }

    /**
     * Set tempsDisponible
     *
     * @param integer $tempsDisponible
     * @return CreditTemps
     */
    public function setTempsDisponible($tempsDisponible)
    {
        $this->tempsDisponible = $tempsDisponible;
    
        return $this;
    }

    /**
     * Get tempsDisponible
     *
     * @return integer 
     */
    public function getTempsDisponible()
    {
        return $this->tempsDisponible;
    }
}