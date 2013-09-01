<?php

namespace Explotic\AdminBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{    
    public function __construct(){
        parent::__construct();
    }
    
    public function __toString()
    {
        if(null!==$this->getLastname()){
            return $this->getFirstname().' '.$this->getLastname();
        }else{
            return $this->getUsername();
        }
        
    }


    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}