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
    /**
     * @var \Transfer\MainBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Transfer\MainBundle\Entity\User $user
     * @return AgentTrsp
     */
    public function setUser(\Transfer\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Transfer\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString() {
        return $this->transporteur->getNom().'/'.$this->getNom().' '.$this->getPrenom();
    }
}