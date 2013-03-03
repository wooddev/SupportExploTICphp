<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Transfer\ProfilBundle\Entity\Profil;

/**
 * AgentTrsp
 */
class AgentTrsp extends Profil
{

    /**
     * @var \Transfer\ProfilBundle\Entity\Transporteur
     */
    private $transporteur;


    /**
     * Set transporteur
     *
     * @param \Transfer\ProfilBundle\Entity\Transporteur $transporteur
     * @return AgentTrsp
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
}