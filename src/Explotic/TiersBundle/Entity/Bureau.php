<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Bureau
 */
class Bureau extends SiteIntervention
{
    /**
     * @var string $adresseRue
     */
    private $adresseRue;

/**
     * Set adresseRue
     *
     * @param string $adresseRue
     * @return Bureau
     */
    public function setAdresseRue($adresseRue)
    {
        $this->adresseRue = $adresseRue;
    
        return $this;
    }

    /**
     * Get adresseRue
     *
     * @return string 
     */
    public function getAdresseRue()
    {
        return $this->adresseRue;
    }
    
    public function __toString() {
        if(!(null===$this->adresseRue)&& !(null===$this->getLocalisation())){
            return $this->adresseRue.', '.$this->getLocalisation()->getCp().', '.$this->getLocalisation()->getCommune();
        }
        return 'Bureau en cours de création';
    }
    
    public function getGps(){
        return 'lat: '.$this->getLocalisation()->getGeometry()->getLat().' - lon: '.$this->getLocalisation()->getGeometry()->getLon();
    }

    /**
     * @var integer
     */
    private $adresseNumero;


    /**
     * Set adresseNumero
     *
     * @param integer $adresseNumero
     * @return Bureau
     */
    public function setAdresseNumero($adresseNumero)
    {
        $this->adresseNumero = $adresseNumero;
    
        return $this;
    }

    /**
     * Get adresseNumero
     *
     * @return integer 
     */
    public function getAdresseNumero()
    {
        return $this->adresseNumero;
    }   


    /**
     * @var \Explotic\TiersBundle\Entity\Entreprise
     */
    private $entreprise;


    /**
     * Set entreprise
     *
     * @param \Explotic\TiersBundle\Entity\Entreprise $entreprise
     * @return Bureau
     */
    public function setEntreprise(\Explotic\TiersBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;
    
        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \Explotic\TiersBundle\Entity\Entreprise 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
}