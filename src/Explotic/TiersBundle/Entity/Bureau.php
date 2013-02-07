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

}