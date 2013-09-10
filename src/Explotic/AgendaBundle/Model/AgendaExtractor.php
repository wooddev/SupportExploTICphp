<?php
namespace Explotic\AgendaBundle\Model;



/**
 * Description of agenda
 *
 * @author arraiolosa
 */
class AgendaExtractor {
    //put your code here


    private $dateDebut;
    private $dateFin;
    private $week;
    private $year;
    private $duree;
    private $agendaEntity;
    
    
    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;
    }

    public function getWeek() {
        return $this->week;
    }

    public function setWeek($week) {
        $this->week = $week;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getDuree() {
        return $this->duree;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
    }
    /**
     * 
     * @return \Explotic\AgendaBundle\Entity\Agenda
     */

    public function getAgendaEntity() {
        return $this->agendaEntity;
    }
    /**
     * 
     * @param \Explotic\AgendaBundle\Entity\Agenda $agendaEntity
     */
    public function setAgendaEntity(\Explotic\AgendaBundle\Entity\Agenda $agendaEntity) {
        $this->agendaEntity = $agendaEntity;
    }        
           
    
    public function init($week,$year, $agenda, $duree = 1){
        
        $this->week = (int) $week;
        $this->year = (int) $year;
        $this->duree= (int) $duree;
        $this->agendaEntity = $agenda;
        
        $this->dateDebut = new \DateTime($this->year.'W'.$this->week."1");
        
        $interval = new \DateInterval("P".$duree."W");
        $this->dateFin = clone $this->dateDebut;
        $this->dateFin->add($interval);
    }
    public function autoInitDates(){
                
        $this->dateDebut = new \DateTime($this->year.'W'.$this->week."1");
        
        $interval = new \DateInterval("P".$this->duree."W");
        $this->dateFin = clone $this->dateDebut;
        $this->dateFin->add($interval);
    }  
    
}

?>