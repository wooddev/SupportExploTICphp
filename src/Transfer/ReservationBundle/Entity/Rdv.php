<?php

namespace Transfer\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 */
class Rdv
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
     * @var string
     */
    private $statutRdv;

    /**
     * @var \Transfer\ReservationBundle\Entity\CreneauRdv
     */
    private $creneauRdv;

    /**
     * Set statutRdv
     *
     * @param string $statutRdv
     * @return Rdv
     */
    public function setStatutRdv($statutRdv)
    {
        $this->statutRdv = $statutRdv;
    
        return $this;
    }

    /**
     * Get statutRdv
     *
     * @return string 
     */
    public function getStatutRdv()
    {
        return $this->statutRdv;
    }

    /**
     * Set creneauRdv
     *
     * @param \Transfer\ReservationBundle\Entity\CreneauRdv $creneauRdv
     * @return Rdv
     */
    public function setCreneauRdv(\Transfer\ReservationBundle\Entity\CreneauRdv $creneauRdv = null)
    {
        $this->creneauRdv = $creneauRdv;
    
        return $this;
    }

    /**
     * Get creneauRdv
     *
     * @return \Transfer\ReservationBundle\Entity\CreneauRdv 
     */
    public function getCreneauRdv()
    {
        return $this->creneauRdv;
    }

    /**
     * @var \Transfer\ProfilBundle\Entity\Transporteur
     */
    
        
    public function init($creneauRdv){
        $this->setCreneauRdv($creneauRdv);                
        $this->setStatutRdv('provisoire');               
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $evenements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add evenements
     *
     * @param \Transfer\ReservationBundle\Entity\Evenement $evenements
     * @return Rdv
     */
    public function addEvenement(\Transfer\ReservationBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;
    
        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \Transfer\ReservationBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\Transfer\ReservationBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->evenements;
    }
}