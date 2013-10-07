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
    private $agendaEntities;    
   
    public function __construct() {
        $this->agendaEntities=  new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getAgendaEntities() {
        return $this->agendaEntities;
    }

    public function setAgendaEntities($agendaEntities) {
        $this->agendaEntities = $agendaEntities;
    }

    
    public function addAgendaEntity($agendaEntity){
        $this->agendaEntities->add($agendaEntity);
    }
    
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
   
    
    public function init($week,$year, $agendas, $duree = 1){
        
        $this->week = (int) $week;
        $this->year = (int) $year;
        $this->duree= (int) $duree;
        $this->agendaEntities = $agendas;
        
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