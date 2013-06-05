<?php

namespace Explotic\TiersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Explotic\TiersBundle\Entity\Salle
 */
class Salle extends SiteIntervention
{
    public function __toString() {
        return $this->getLocalisation()->__toString();
    }

}