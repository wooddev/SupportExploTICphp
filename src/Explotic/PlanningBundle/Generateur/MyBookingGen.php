<?php
namespace Explotic\PlanningBundle\Generateur;

/**
 * Description of MyBookingEngine
 *
 * @author Adrien Arraiolos
 */
class MyBookingGen extends \Explotic\AgendaBundle\Generateurs\BookingGen{
    private 
            //Options choisies par l'utilisateur
            $calendrier;   
    
    public function getCalendrier() {
        return $this->calendrier;
    }

    public function setCalendrier(\Explotic\PlanningBundle\Entity\Calendrier $calendrier) {
        $this->calendrier = $calendrier;
    }
    
    public function getOptions() {
        $this->options= array(
                    'calendrier'=>$this->getCalendrier(),
            );
        return $this->options;   
    }
    
        
    public function init($slots, $calendrier){
        parent::init($slots);
        $this->calendrier = $calendrier; 
    }
    
    


    
            
}

?>
