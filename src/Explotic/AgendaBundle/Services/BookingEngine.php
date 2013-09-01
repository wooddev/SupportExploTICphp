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
            $bookingTypes;
    public function __construct(EntityManager $em, array $bookingTypes) {
        $this->em = $em;
        $this->bookingTypes = $bookingTypes;
    }
    
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
