<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentReception
 */
class AgentReception extends \Application\Sonata\UserBundle\Entity\User
{
     protected static $roles_const=array("ROLE_RECEP");
}