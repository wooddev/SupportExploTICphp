<?php

namespace Explotic\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyBooking
 */
class MyBooking extends \Explotic\AgendaBundle\Entity\Rdv
{

    /**
     * @var \Explotic\PlanningBundle\Entity\Calendrier
     */
    private $calendrier;


    /**
     * Set calendrier
     *
     * @param \Explotic\PlanningBundle\Entity\Calendrier $calendrier
     * @return MyBooking
     */
    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier = null)
    {
        $this->calendrier = $calendrier;
    
        return $this;
    }

    /**
     * Get calendrier
     *
     * @return \Explotic\PlanningBundle\Entity\Calendrier 
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }
    
    public function init($creneauRdv,$statutRdv,$options=null){
        parent::init($creneauRdv,$statutRdv);
        $this->setCalendrier($options['calendrier']);
    }
}