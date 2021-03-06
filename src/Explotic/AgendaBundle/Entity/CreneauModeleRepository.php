<?php

namespace Explotic\AgendaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CreneauModeleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CreneauModeleRepository extends EntityRepository
{
    
    public function findAll(){
        $query = $this->getEntityManager()->createQuery(
                "SELECT c
                FROM ExploticAgendaBundle:CreneauModele c
                ORDER BY c.jour, c.heureDebut
                    "
                );
        return $query->getResult();
    }
}
