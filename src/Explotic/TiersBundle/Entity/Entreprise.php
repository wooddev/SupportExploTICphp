<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Entreprise
 */
class Entreprise
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $raisonSociale
     */
    private $raisonSociale;

    /**
     * @var string $telephone
     */
    private $telephone;

    /**
     * @var Explotic\TiersBundle\Entity\Bureau
     */
    private $bureau;

    /**
     * @var Explotic\PlanningBundle\Entity\CreditTemps
     */
    private $creditTemps;


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
     * Set raisonSociale
     *
     * @param string $raisonSociale
     * @return Entreprise
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;
    
        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string 
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Entreprise
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set bureau
     *
     * @param Explotic\TiersBundle\Entity\Bureau $bureau
     * @return Entreprise
     */
    public function setBureau(\Explotic\TiersBundle\Entity\Bureau $bureau = null)
    {
        $this->bureau = $bureau;
    
        return $this;
    }

    /**
     * Get bureau
     *
     * @return Explotic\TiersBundle\Entity\Bureau 
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * Set creditTemps
     *
     * @param Explotic\PlanningBundle\Entity\CreditTemps $creditTemps
     * @return Entreprise
     */
    public function setCreditTemps(\Explotic\PlanningBundle\Entity\CreditTemps $creditTemps = null)
    {
        $this->creditTemps = $creditTemps;
    
        return $this;
    }

    /**
     * Get creditTemps
     *
     * @return Explotic\PlanningBundle\Entity\CreditTemps 
     */
    public function getCreditTemps()
    {
        return $this->creditTemps;
    }
    
    public function __toString() {
        return $this->getRaisonSociale().' ('.$this->getBureau()->getLocalisation()->getCommune().')';
    }
}