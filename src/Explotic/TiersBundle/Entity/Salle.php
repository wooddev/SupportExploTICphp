<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Salle
 */
class Salle extends SiteIntervention
{
    public function __toString() {
        if(!(null===$this->getLocalisation())){
            return $this->getLabel().'/'.$this->getLocalisation()->__toString();
        }
        return 'Salle en cours de création';
    }

    /**
     * @var string
     */
    private $adresseRue;


    /**
     * Set adresseRue
     *
     * @param string $adresseRue
     * @return Salle
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
    /**
     * @var \Explotic\TiersBundle\Entity\Organisme
     */
    private $organisme;


    /**
     * Set organisme
     *
     * @param \Explotic\TiersBundle\Entity\Organisme $organisme
     * @return Salle
     */
    public function setOrganisme(\Explotic\TiersBundle\Entity\Organisme $organisme = null)
    {
        $this->organisme = $organisme;
    
        return $this;
    }

    /**
     * Get organisme
     *
     * @return \Explotic\TiersBundle\Entity\Organisme 
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }
}