<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Localisation
 */
class Localisation
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $commune
     */
    private $commune;

    /**
     * @var string $cp
     */
    private $cp;

    /**
     * @var Explotic\TiersBundle\Entity\Geometry
     */
    private $geometry;


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
     * Set commune
     *
     * @param string $commune
     * @return Localisation
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
    
        return $this;
    }

    /**
     * Get commune
     *
     * @return string 
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Localisation
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set geometry
     *
     * @param Explotic\TiersBundle\Entity\Geometry $geometry
     * @return Localisation
     */
    public function setGeometry(\Explotic\TiersBundle\Entity\Geometry $geometry = null)
    {
        $this->geometry = $geometry;
    
        return $this;
    }
    
    /**
     * Get geometry
     *
     * @return Explotic\TiersBundle\Entity\Geometry 
     */
    public function getGeometry()
    {
        return $this->geometry;
    }
    
    public function __toString()
    {
       $string="Commune: ".$this->getCommune()."  CP: ".$this->getCp();  
       return $string;
    }
        /*
     * Surcharge des méthodes
     *
    
    public function __call( $method, $args)
    {
        switch($method)
        {
            /*
             * Surcharge de la méthode setGeometry
             * setGeometry($lat,$lon)
             *
            case setGeometry :
                if (    (count($args)==2) && 
                        (gettype($args[0]=='string')) &&         // lat
                        (gettype($args[1]=='string')) )          // lon
                {
                    $this->geometry= new geometry();
                    $this->geometry->setLat($args[0]);
                    $this->geometry->setLon($args[1]);                    
                    return $this;                    
                }                                                      
        }              
    }
    */

}