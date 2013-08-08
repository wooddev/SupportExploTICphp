<?php

namespace Transfer\ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentReception
 */
class AgentReception extends \Transfer\MainBundle\Entity\User
{
     protected static $roles_const=array("ROLE_RECEP");
}