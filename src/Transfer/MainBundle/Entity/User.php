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

    protected static $roles_const = array();
    
    public function __construct() {
        parent::__construct();
        
//        if(!self::$roles_const){
//            if(is_array(self::$roles_const)){
//                foreach( self::$roles_const as $role){
//                    $this->addRole($role);
//                }
//            }
//        }
        
    }
    
    public function prePersistAction(){        
        if(is_array(static::$roles_const)){ 
            $roles = static::$roles_const;
            foreach( $roles as $role){
                $this->addRole($role);                
            }
        }
        $this->setEnabled(true);
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
   


//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    protected $groups;
//
//
//    /**
//     * Add groups
//     *
//     * @param \Transfer\MainBundle\Entity\Group $groups
//     * @return User
//     */
//    public function addGroup(\Transfer\MainBundle\Entity\Group $groups)
//    {
//        $this->groups[] = $groups;
//    
//        return $this;
//    }
//
//    /**
//     * Remove groups
//     *
//     * @param \Transfer\MainBundle\Entity\Group $groups
//     */
//    public function removeGroup(\Transfer\MainBundle\Entity\Group $groups)
//    {
//        $this->groups->removeElement($groups);
//    }
//
//    /**
//     * Get groups
//     *
//     * @return \Doctrine\Common\Collections\Collection 
//     */
//    public function getGroups()
//    {
//        return $this->groups;
//    }
}