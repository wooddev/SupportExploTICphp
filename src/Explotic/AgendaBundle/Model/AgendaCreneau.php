<?php
namespace Explotic\AgendaBundle\Model;


/**
 * Description of AgendaCreneau
 *
 * @author adrien
 */

class AgendaCreneau{
    private $val;
    private $creneauStructure;
    private $creneauxAffiches;
    private $dateTimeDebut;
    private $dateTimeFin;
    private $year;
    private $week;
    private $day;
    private $minuteDebut; // minutes de début et fin du créneau % à la journée
    private $duree;
    private $type;
                
    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getWeek() {
        return $this->week;
    }

    public function setWeek($week) {
        $this->week = $week;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

        
    public function getCreneauStructure() {
        return $this->creneauStructure;
    }

    public function getCreneauxAffiches() {
        return $this->creneauxAffiches;
    }
    
    public function getDateTimeDebut() {
        return $this->dateTimeDebut;
    }

    public function getDateTimeFin() {
        return $this->dateTimeFin;
    }

    public function getMinuteDebut() {
        return $this->minuteDebut;
    }

    public function getDuree() {
        return $this->duree;
    }

    public function setCreneauStructure($CreneauStructure) {
        $this->creneauStructure = $CreneauStructure;
    }

    public function AddCreneauAffiche($CreneauAffiche) {
        $this->creneauxAffiches->add($CreneauAffiche);
    }
    
    public function setDateTimeDebut($dateTimeDebut) {
        $this->dateTimeDebut = $dateTimeDebut;
    }

    public function setDateTimeFin($dateTimeFin) {
        $this->dateTimeFin = $dateTimeFin;
    }

    public function setMinuteDebut($minuteDebut) {
        $this->minuteDebut = $minuteDebut;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
    }
    
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    
    public function __construct($creneauStructure,                                                
                        $dateTimeDebut,$dateTimeFin,
                        $type)
    {
        $this->creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection();
        $this->init($creneauStructure,                                                
                        $dateTimeDebut,$dateTimeFin,
                        $type);
    }

        
    public function init($creneauStructure,                                                
                        $dateTimeDebut,$dateTimeFin,
                        $type)
    {
        $this->creneauStructure = $creneauStructure;
        $this->dateTimeDebut = $dateTimeDebut;
        $this->dateTimeFin = $dateTimeFin;        
        $this->year = idate('Y',$dateTimeDebut->getTimestamp());
        $this->week = idate('W',$dateTimeDebut->getTimestamp());
        $this->minuteDebut =    idate('i',$dateTimeDebut->getTimestamp())+
                                (idate('H',$dateTimeDebut->getTimestamp())*60);        
        $this->duree =  idate('i',$dateTimeFin->getTimestamp())+
                        (idate('H',$dateTimeFin->getTimestamp())*60) 
                        -$this->minuteDebut;
        $this->type = $type;
    }
      
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
    
}

?>
