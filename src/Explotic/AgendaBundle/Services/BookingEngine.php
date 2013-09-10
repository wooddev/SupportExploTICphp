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
    
    public function __construct(EntityManager $em, array $bookingTypes) {
        $this->em = $em;
//        $array= array(
//                'session' => array(
//                    'status_options'=>['Prévue','Fixée','Réalisée','Annulée'],
//                    'default_status'=>'Prévue',
//                    'booking_class'=>'Explotic\AgendaBundle\Entity\Rdv',
//                    ),
//                'tiers' => array(
//                    'status_options'=>['Disponible','Indisponible'],
//                    'default_status'=>'Disponible',
//                    'booking_class'=>'Explotic\AgendaBundle\Entity\Rdv',
//                    ),
//                );
        
        $this->bookingTypes = $bookingTypes;
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
    public function tryBooking($slot, $typeBooking,$agenda, $bookingSelectedOption,$options){
        //$slotClass= get_class($slot);
        //$slotSync = $this->em->getRepository($slotClass)->find($slot->getId());
        $booking = new $this->bookingTypes[$typeBooking]['booking_class']();
        if($bookingSelectedOption==null){
            $bookingSelectedOption = $this->bookingTypes[$typeBooking]['default_status'];
        }
        $booking->init($slot,$bookingSelectedOption,$agenda,$options);
        if($this->bookingAuthorizer($typeBooking,$booking)){
            $this->em->persist($booking);
            $this->em->flush();
            return true;
        }else{
            return false;
        }
               
    }
    /**
     * 
     * @param type $booking
     * @return boolean
     */
    public function bookingAuthorizer($typeBooking,$booking){
        $formerBooking = $this->em
                            ->getRepository($this->bookingTypes[$typeBooking]['booking_class'])
                                ->findExists($booking);        
        if(!$formerBooking){
            return true; //si rien de trouvé => on persiste le booking en cours
        }else{
            $this->editStatus($formerBooking[0],$booking->getStatutRdv());
            return false; // On refuse l'autorisation de persister le booking en cours
        }
            
        
        
    }
    
    public function editStatus($booking,$status){
        $booking->setStatutRdv($status);
        $this->em->persist($booking);
        $this->em->flush();
    }
}

?>
