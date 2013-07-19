<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParamReservation
 */
class ParamReservation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var array
     */
    private $parametres;


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
     * Set parametres
     *
     * @param array $parametres
     * @return ParamReservation
     */
    public function setParametres($parametres)
    {
        $this->parametres = $parametres;
    
        return $this;
    }

    /**
     * Get parametres
     *
     * @return array 
     */
    public function getParametres()
    {
        return $this->parametres;
    }

    
    /**
     * @var array
     */
    private $parametresReserves;


    /**
     * Set parametresReserves
     *
     * @param array $parametresReserves
     * @return ParamReservation
     */
    public function setParametresReserves($parametresReserves)
    {
        $this->parametresReserves = $parametresReserves;
    
        return $this;
    }

    /**
     * Get parametresReserves
     *
     * @return array 
     */
    public function getParametresReserves()
    {
        return $this->parametresReserves;
    }
}