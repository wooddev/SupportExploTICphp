<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Transfer\ProfilBundle\Entity\Profil;


/**
 * AgentDab
 */
class AgentDab extends Profil
{

    /**
     * @var \Transfer\MainBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Transfer\MainBundle\Entity\User $user
     * @return AgentDab
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
        return $this->getNom().' '.$this->getPrenom();
    }
}