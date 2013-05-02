<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibilite
 */
class Disponibilite
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $valeur;


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
     * Set valeur
     *
     * @param integer $valeur
     * @return Disponibilite
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {
        return $this->valeur;
    }
    /**
     * @var \Transfer\ReservationBundle\Entity\TypeCamion
     */
    private $typeCamion;

    /**
     * @var \Transfer\ReservationBundle\Entity\Creneau
     */
    private $creneau;


    /**
     * Set typeCamion
     *
     * @param \Transfer\ReservationBundle\Entity\TypeCamion $typeCamion
     * @return Disponibilite
     */
    public function setTypeCamion(\Transfer\ReservationBundle\Entity\TypeCamion $typeCamion = null)
    {
        $this->typeCamion = $typeCamion;
    
        return $this;
    }

    /**
     * Get typeCamion
     *
     * @return \Transfer\ReservationBundle\Entity\TypeCamion 
     */
    public function getTypeCamion()
    {
        return $this->typeCamion;
    }

    /**
     * Set creneau
     *
     * @param \Transfer\ReservationBundle\Entity\Creneau $creneau
     * @return Disponibilite
     */
    public function setCreneau(\Transfer\ReservationBundle\Entity\Creneau $creneau = null)
    {
        $this->creneau = $creneau;
    
        return $this;
    }

    /**
     * Get creneau
     *
     * @return \Transfer\ReservationBundle\Entity\Creneau 
     */
    public function getCreneau()
    {
        return $this->creneau;
    }
    
    function __construct($valeur = null, 
                        \Transfer\ReservationBundle\Entity\TypeCamion $typeCamion = null, 
                        \Transfer\ReservationBundle\Entity\Creneau $creneau = null) 
    {
        if(!($valeur ==null) AND !($typeCamion==null) AND !($creneau==null)){
            $this->valeur = $valeur;
            $this->typeCamion = $typeCamion;
            $this->creneau = $creneau;
        }
    }

}