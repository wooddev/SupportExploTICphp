<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentTrsp
 */
class AgentTrsp extends \Application\Sonata\UserBundle\Entity\User
{
     protected static $roles_const = array('ROLE_TRANSPORTEUR');
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

    
//    public function __toString() {
//        if($this->transporteur && $this->transporteur->getUserName()){
//        return $this->transporteur->getNom().'/'.$this->getLastname().' '.$this->getFirstName();
//        }
//        else{
//            return $this->getLastname().' '.$this->getFirstName();
//        }
//    }
}