<?php
namespace Explotic\AgendaBundle\Services;

use Doctrine\ORM\EntityManager;


/**
 * Description of BookingEngine
 *
 * @author Grumpf
 */
class BookingEngine {
    //put your code here
    private $em,
            $bookingTypes; //Conlfiguration des bookings, définie dans config.ym
    
    public function __construct(EntityManager $em/*, array $bookingTypes*/) {
        $this->em = $em;
        $this->bookingTypes = array(
                'session' => array(
                    'status_options'=>array('Prévue','Fixée','Réalisée','Annulée'),
                    'default_status'=>array('Prévue'),
                    'booking_class'=>'Explotic\PlanningBundle\Entity\MyBooking',
                    ),
                'tiers' => array(
                    'status_options'=>array('Disponible','Indisponible'),
                    'default_status'=>array('Disponible'),
                    'booking_class'=>'Explotic\PlanningBundle\Entity\MyBooking',
                    ),
                );
    }    
    
        
    /**
     * Méthode permettant la réservation d'un slot en créant un booking rattaché
     * 
     * @param type $slot
     * @param type $typeBooking
     * @param type $options
     * @return boolean
     */
    public function tryBooking($slot, $typeBooking, $options){
        //$slotClass= get_class($slot);
        //$slotSync = $this->em->getRepository($slotClass)->find($slot->getId());
        $booking = new $this->bookingTypes[$typeBooking]['booking_class']();
        $booking->init($slot,$this->bookingTypes[$typeBooking]['default_status'],$options);
        $this->em->persist($booking);
        $this->em->flush();
        return true;       
    }
    
    public function editStatus($booking,$status){
        $booking->setStatutRdv($status);
        $this->em->persist($booking);
        $this->em->flush();
    }
}

?>
