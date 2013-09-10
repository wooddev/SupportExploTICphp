<?php

namespace Explotic\AgendaBundle\Generateurs;
/**
 * Description of BookingGenerator
 *
 * @author Wooddev
 */
class BookingGen {    
    protected $bookingEngine,
            $agenda,
            //Créneaux  disponibles
            $slots,
            // rdvs générés
            $bookings,
            //Options de réservation
            $options,
            //type de réservation
            $bookingType,
            //Option de réservation choisie (statut de la résa)
            $bookingSelectedOption;

    public function __construct(\Explotic\AgendaBundle\Services\BookingEngine $moteurReservation){
        $this->slots = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookingEngine = $moteurReservation;        
        return $this;
    }  
    public function getBookingSelectedOption() {
        return $this->bookingSelectedOption;
    }

    public function setBookingSelectedOption($bookingSelectedOption) {
        $this->bookingSelectedOption = $bookingSelectedOption;
    }

        public function getAgenda() {
        return $this->agenda;
    }

    public function setAgenda(\Explotic\AgendaBundle\Entity\Agenda $agenda) {
        $this->agenda = $agenda;
    }

        public function getBookingEngine() {
        return $this->bookingEngine;
    }

    public function setBookingEngine($bookingEngine) {
        $this->bookingEngine = $bookingEngine;
    }

        
    public function getSlots() {
         return $this->slots;
    } 
    
    public function addSlot(\Explotic\AgendaBundle\Entity\CreneauRdv $slot){
        $this->slots->Add($slot);
        return $this;
    }
    public function removeSlot(\Explotic\AgendaBundle\Entity\CreneauRdv $slot){
        $this->slots->removeElement($slot);
        return $this;
    }
    
    public function getBookings(){
        if (!$this->bookings) {
            throw new Exception('Aucune réservation associée');
        }
        else return $this->bookings;
    }        
    public function addBooking(\Explotic\AgendaBundle\Entity\Rdv $booking){
        $this->bookings->add($booking);
        return $this;
    }
    public function removeBooking(\Explotic\AgendaBundle\Entity\Rdv $booking){
        $this->bookings->removeElement($booking);
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
   
    public function init($slots,$agenda,$bookingType)
    {
        $this->slots = $slots;
        $this->agenda = $agenda;
        $this->bookingType = $bookingType;
        $this->options= array();
    }
    
    public function book(){
        foreach($this->slots as $slot){
            $this->bookingEngine->tryBooking($slot, $this->bookingType,$this->agenda,$this->bookingSelectedOption,$this->getOptions());
        }        
    }   
}

?>
