<?php

namespace Transfer\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup;

/**
 * Group
 */
class Group extends BaseGroup
{
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