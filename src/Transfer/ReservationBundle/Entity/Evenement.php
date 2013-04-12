<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 */
class Evenement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateRealisation;


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
     * Set dateRealisation
     *
     * @param \DateTime $dateRealisation
     * @return Evenement
     */
    public function setDateRealisation($dateRealisation)
    {
        $this->dateRealisation = $dateRealisation;
    
        return $this;
    }

    /**
     * Get dateRealisation
     *
     * @return \DateTime 
     */
    public function getDateRealisation()
    {
        return $this->dateRealisation;
    }
    /**
     * @var \Transfer\ProfilBundle\Entity\Transporteur
     */
    private $transporteur;

    /**
     * @var \Transfer\ReservationBundle\Entity\Rdv
     */
    private $rdv;


    /**
     * Set transporteur
     *
     * @param \Transfer\ProfilBundle\Entity\Transporteur $transporteur
     * @return Evenement
     */
    public function setTransporteur(\Transfer\ProfilBundle\Entity\Transporteur $transporteur = null)
    {
        $this->transporteur = $transporteur;
    
        return $this;
    }

    /**
     * Get transporteur
     *
     * @return \Transfer\ProfilBundle\Entity\Transporteur 
     */
    public function getTransporteur()
    {
        return $this->transporteur;
    }

    /**
     * Set rdv
     *
     * @param \Transfer\ReservationBundle\Entity\Rdv $rdv
     * @return Evenement
     */
    public function setRdv(\Transfer\ReservationBundle\Entity\Rdv $rdv = null)
    {
        $this->rdv = $rdv;
    
        return $this;
    }

    /**
     * Get rdv
     *
     * @return \Transfer\ReservationBundle\Entity\Rdv 
     */
    public function getRdv()
    {
        return $this->rdv;
    }
    /**
     * @var string
     */
    private $type;


    /**
     * Set type
     *
     * @param string $type
     * @return Evenement
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    function __construct() {
        $this->dateRealisation = new \DateTime('NOW');
    }

}