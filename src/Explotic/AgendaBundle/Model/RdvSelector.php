<?php
namespace Explotic\AgendaBundle\Model;

    

/**
 * Description of RdvSelector
 *
 * @author arraiolosa
 */
class RdvSelector {
    //put your code here
   private $agenda,
           $bookingType,
           $dateDebut,
           $period;
   
   public function getAgenda() {
       return $this->agenda;
   }

   public function setAgenda(\Explotic\AgendaBundle\Entity\Agenda $agenda) {
       $this->agenda = $agenda;
   }

   public function getBookingType() {
       return $this->bookingType;
   }

   public function setBookingType($bookingType) {
       $this->bookingType = $bookingType;
   }

   public function getDateDebut() {
       return $this->dateDebut;
   }

   public function setDateDebut(\DateTime $dateDebut) {
       $this->dateDebut = $dateDebut;
   }

   public function getPeriod() {
       return $this->period;
   }

   public function setPeriod($period) {
       $this->period = $period;
   }


}

?>
