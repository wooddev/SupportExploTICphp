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

     protected static $roles_const = null;
    
    public function __construct() {
        parent::__construct();
        
        if(!self::$roles_const){
            if(is_array(self::$roles_const)){
                foreach( self::$roles_const as $role){
                    $this->addRole($role);
                }
            }
        }
        
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
   


}