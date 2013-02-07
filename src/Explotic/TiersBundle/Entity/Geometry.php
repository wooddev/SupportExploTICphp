<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Geometry
 */
class Geometry
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var float $lat
     */
    private $lat;

    /**
     * @var float $lon
     */
    private $lon;


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
     * Set lat
     *
     * @param float $lat
     * @return Geometry
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param float $lon
     * @return Geometry
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    
        return $this;
    }

    /**
     * Get lon
     *
     * @return float 
     */
    public function getLon()
    {
        return $this->lon;
    }
    
    /**
     * __toString
     * 
     */
    public function __toString()
    {
        $string= "lat: ".$this->getLat()." lon: ".$this->getLon();
        return $string;
    }
}