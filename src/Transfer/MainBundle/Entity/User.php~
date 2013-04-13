<?php

namespace Transfer\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    
    public function __construct() {
        parent::__construct();
    }

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
     * @var \Transfer\ProfilBundle\Entity\AgentDab
     */
    private $agentDab;

    /**
     * @var \Transfer\ProfilBundle\Entity\AgentTrsp
     */
    private $agentTrsp;


    /**
     * Set agentDab
     *
     * @param \Transfer\ProfilBundle\Entity\AgentDab $agentDab
     * @return User
     */
    public function setAgentDab(\Transfer\ProfilBundle\Entity\AgentDab $agentDab = null)
    {
        $this->agentDab = $agentDab;
    
        return $this;
    }

    /**
     * Get agentDab
     *
     * @return \Transfer\ProfilBundle\Entity\AgentDab 
     */
    public function getAgentDab()
    {
        return $this->agentDab;
    }

    /**
     * Set agentTrsp
     *
     * @param \Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsp
     * @return User
     */
    public function setAgentTrsp(\Transfer\ProfilBundle\Entity\AgentTrsp $agentTrsp = null)
    {
        $this->agentTrsp = $agentTrsp;
    
        return $this;
    }

    /**
     * Get agentTrsp
     *
     * @return \Transfer\ProfilBundle\Entity\AgentTrsp 
     */
    public function getAgentTrsp()
    {
        return $this->agentTrsp;
    }
}