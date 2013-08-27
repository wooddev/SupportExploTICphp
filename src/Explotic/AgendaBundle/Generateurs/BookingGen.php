<?php

namespace Explotic\AgendaBundle\Generateurs;
/**
 * Description of BookingGenerator
 *
 * @author Wooddev
 */
class BookingGen {    
    protected $bookingEngine,
            //Créneaux Modèles disponibles
            $slots,
            // Créneaux prefs générés
            $bookings,
            //Options de réservation
            $options,
            //type de réservation
            $bookingType;

    public function __construct(\Transfer\ReservationBundle\Services\MoteurReservation $moteurReservation){
        $this->slots = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookingEngine = $moteurReservation;        
        return $this;
    }    

    public function getSlots() {
        if (!$this->slots) {
            throw new Exception('Aucun créneau associé');
        }
        else return $this->slots;
    } 

    public function setSlots($collection){
        $this->slot = $collection;
        return $this;
    }
    
    public function addSlot($slot){
        $this->slots->Add($slot);
        return $this;
    }
    
    public function getBookings(){
        if (!$this->bookings) {
            throw new Exception('Aucune réservation associée');
        }
        else return $this->bookings;
    }        
    
    public function getOptions() {
        return $this->options;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function getBookingType() {
        return $this->bookingType;
    }

    public function setBookingType($bookingType) {
        $this->bookingType = $bookingType;
    }

        
    
     /**
     * function init
     * 
     * Permet d'initialiser la classe en dehors du constructeur     * 
     */
   
    public function init($slots,$bookingType)
    {
        $this->slots = $slots;
        $this->bookingType = $bookingType;
        $this->options= array();
    }
    
    public function book(){
        foreach($this->slots as $slot){
            $this->bookingEngine->book($slot, $this->bookingType,$this->getOptions());
        }        
    }   
}

?>
