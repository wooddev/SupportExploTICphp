<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\SiteIntervention
 */
class SiteIntervention
{
    /**
     * @var integer $id
     */
    private $id;
    
    protected $label;
    
    public function __construct() {
        $this->calendrier = new \Explotic\PlanningBundle\Entity\Calendrier();
        $this->calendrier->setLabel($this->label);
    }

    /**
     * @var Explotic\TiersBundle\Entity\Localisation
     */
    protected $localisation;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

        
    /**
     * Set localisation
     *
     * @param Explotic\TiersBundle\Entity\Localisation $localisation
     * @return SiteIntervention
     */
    public function setLocalisation(\Explotic\TiersBundle\Entity\Localisation $localisation = null)
    {
        $this->localisation = $localisation;
    
        return $this;
    }
    
    /**
     * Get localisation
     *
     * @return Explotic\TiersBundle\Entity\Localisation 
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }
    
    /*
     * Surcharge des méthodes
     */
    /*
    public function __call($method,$args)
    {
        switch($method)
        {
            /*
             * Surcharge de la méthode setLocalisation
             * setLocalisation($commune, $CP, $geometry)
             * setLocalisation($commune, $CP, $lat, $lon)
             *
            case setLocalisation :
                if (    (count($args)==3) && 
                        (gettype($args[0]=='string')) &&         // commune
                        (gettype($args[1]=='string'))  &&        // CP
                        (gettype($args[2]=='Geometry')))         // Geometry
                {
                    $this->localisation= new localisation();
                    $this->localisation->setCommune($args[0]);
                    $this->localisation->setCp($args[1]);
                    $this->localisation->setGeometry($args[2]);
                    return $this;                    
                }                             
                if (    (count($args)==4) && 
                        (gettype($args[0]=='string'))  &&        // commune
                        (gettype($args[1]=='string'))  &&        // CP
                        (gettype($args[2]=='string'))  &&        // lat
                        (gettype($args[3]=='string')))           // lon
                {
                    $this->localisation= new localisation();
                    $this->localisation->setCommune($args[0]);
                    $this->localisation->setCp($args[1]);
                    $geom = new Geometry();
                    $this->localisation->setGeometry($lat,$long);
                    return $this;                    
                }                             
        }              
    }
    */
    
    /**
     * @var Explotic\PlanningBundle\Entity\Calendrier
     */
    protected $calendrier;


    /**
     * Set calendrier
     *
     * @param Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return SiteIntervention
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
     * @var string
     */
    private $commentaires;


    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return SiteIntervention
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}