<?php

namespace Transfer\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

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
     * @var \Transfer\ProfilBundle\Entity\Profil
     */
    private $profil;


    /**
     * Set profil
     *
     * @param \Transfer\ProfilBundle\Entity\Profil $profil
     * @return User
     */
    public function setProfil(\Transfer\ProfilBundle\Entity\Profil $profil = null)
    {
        $this->profil = $profil;
    
        return $this;
    }

    /**
     * Get profil
     *
     * @return \Transfer\ProfilBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }
}