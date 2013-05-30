<?php
namespace Explotic\AgendaBundle\Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use Doctrine\Common\Collections\Criteria;
use Explotic\AgendaBundle\Model\AgendaDay;

/**
 * Description of agenda
 *
 * @author arraiolosa
 */
class Agenda {
    //put your code here
    private $agendasYear;
    private $val;
    private $dateDebut;
    private $dateFin;
    private $week;
    private $year;
    private $creneauxAgenda;
    private $poste;
    
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

    public function getPoste() {
        return $this->poste;
    }

    public function setPoste($poste) {
        $this->poste = $poste;
    }

    public function __construct(){         
        $this->agendasYear = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauxAgenda = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getAgendasYear(){
        return $this->agendasYear;
    }
    public function addAgendaYear($var){
        $this->agendasYear->add($var);
        return $this;
    }
    
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function getDateFin(){
        return $this->dateFin;
    }   
    public function getCreneauxAgenda() {
        return $this->creneauxAgenda;
    }
    public function init($week,$year, $poste = null, $duree = 1){
        
        $this->week = (int) $week;
        $this->year = (int) $year;
        $this->poste = $poste;
        
        $this->dateDebut = new \DateTime($this->year.'W'.$this->week."1");
        
        
        if($week>48){ // gestion de la fin d'année ici aussi
            $this->dateFin = new \DateTime(($this->year+1).'W'.($this->week+$duree-1-52)."6");
        }else $this->dateFin = new \DateTime(($this->year).'W'.($this->week+$duree-1)."6");
    }             
    
    public function generateAgenda($creneauxStructures, $creneauxAffiches,$minDebut = null ,$minFin = null){
        $year = $this->year;
        $week= $this->week;  
        $minutesDebutJours = $minDebut;
        $minutesFinJours = $minFin;
        $week0 = (int) $this->dateDebut->format('W');
        $weekn = (int) $this->dateFin->format('W');
        //On créé un agenda pour l'année
        $this->agendasYear->add(new AgendaYear());
        $this->agendasYear->last()->setVal((int)$year);
        // Le calendrier s'étale sur $nbSemaines
        for ($s = $week0; $s<=$weekn && $s<=52; $s++)
        {
            $this->agendasYear->last()->addAgendaWeek(new AgendaWeek());
            $this->agendasYear->last()->getAgendasWeek()->last()->setVal($s); // Création d'une semaine d'agenda portant le numéro $s
            
            // Sur 6 jours
            for($j=1; $j<=5;$j++){                
                $this->agendasYear->last()->getAgendasWeek()->last()->addAgendaDay(new AgendaDay());                                                
                $this->agendasYear->last()->getAgendasWeek()->last()
                                        ->getAgendasDay()->last()
                                            ->setMinuteDebut($minutesDebutJours);
                $this->agendasYear->last()->getAgendasWeek()->last()
                                        ->getAgendasDay()->last()
                                            ->setMinuteFin($minutesFinJours);
                $criteria = Criteria::create()
                        ->Where(Criteria::expr()
                                    ->eq("jour",$j))
                        ->andWhere(Criteria::expr()
                                    ->eq("annee",$year))
                        ->andWhere(Criteria::expr()
                                    ->eq("semaine",$week))
                        ->orderBy(array("heureDebut"=>"ASC"));   
                $creneauxSelect = $creneauxStructures->matching($criteria);
                
                $this->agendasYear->last()->getAgendasWeek()->last()
                                ->getAgendasDay()->last()
                                    ->init($j,$year,$week,$creneauxSelect,
                                                        $creneauxAffiches);  
            }
        }
    }
}

class AgendaYear{
    private $agendasWeek;
    private $val;
    
    public function __construct(){         
        $this->agendasWeek = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getAgendasWeek(){
        return $this->agendasWeek;
    }
    public function addAgendaWeek($var){
        $this->agendasWeek->add($var);
        return $this;
    }
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
}

class AgendaWeek{
    private $agendasDay;
    private $val;
    
    public function __construct(){         
        $this->agendasDay = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getAgendasDay(){
        return $this->agendasDay;
    }
    public function addAgendaDay($var){
        $this->agendasDay->add($var);
        return $this;
    }
    public function getVal(){
        return $this->val;
    }
    public function setVal( $var){
        $this->val = $var;
        return $this;
    }
}
?>
