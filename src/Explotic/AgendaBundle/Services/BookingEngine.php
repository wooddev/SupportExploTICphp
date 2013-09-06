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
        $array= array(
                'session' => array(
                    'status_options'=>['Prévue','Fixée','Réalisée','Annulée'],
                    'default_status'=>['Prévue'],
                    'booking_class'=>['Explotic\PlanningBundle\Entity\MyBooking'],
                    ),
                'tiers' => array(
                    'status_options'=>['Disponible','Indisponible'],
                    'default_status'=>['Disponible'],
                    'booking_class'=>['Explotic\PlanningBundle\Entity\MyBooking'],
                    ),
                );
        
        $this->bookingTypes = $array;
        return $this;
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
