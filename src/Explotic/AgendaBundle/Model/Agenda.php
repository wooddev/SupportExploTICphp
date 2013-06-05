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
        
        $interval = new \DateInterval("P".$duree."W");
        $this->dateFin = clone $this->dateDebut;
        $this->dateFin->add($interval);

    }             
    
    /**
     * 
     * @param type $creneauxStructures >> créneaux utilisés comme support d'agenda
     * @param type $creneauxAffiches >> Créneaux où un rdv a été posé
     * @param type $minDebut >> minutes de démarrage de journée
     * @param type $minFin >> minutes de fin de journée
     * @param type $jn >> nb de journées par semaine
     */
    
    public function generateAgenda($creneauxStructures, $creneauxAffiches,$minDebut = null ,$minFin = null,$jn = 5){
        
        $semaineDebut =(int) $this->dateDebut->format('W');
        $anneeDebut = (int)$this->dateDebut->format('Y');
        $semaineFin = (int)$this->dateFin->format('W');
        $anneeFin = (int)$this->dateFin->format('Y');
        
        if($anneeDebut == $anneeFin){
             //On créé un agenda pour l'année
            $this->agendasYear->add(new AgendaYear());
            $this->agendasYear->last()->setVal($anneeDebut);
            for($s=$semaineDebut; $s <$semaineFin;$s++){
                $this->generateForWeek($s,$anneeDebut,$jn,$creneauxStructures, $creneauxAffiches,$minDebut,$minFin);
            } 
            
        }else{        
            for ($a = $anneeDebut; $a <= $anneeFin ; $a++){
                //On créé un agenda pour l'année
                $this->agendasYear->add(new AgendaYear());
                $this->agendasYear->last()->setVal($a);
                if ($a == $anneeDebut){                   
                    for($s= $semaineDebut; $s <=date("W", mktime(0, 0, 0, 12, 28, $a));$s++){
                        $this->generateForWeek($s,$a,$jn,$creneauxStructures, $creneauxAffiches,$minDebut,$minFin);
                    }            
                }
                elseif ($a == $anneeFin){
                    for($s=1 ; $s <=$semaineFin;$s++){
                        $this->generateForWeek($s,$a,$jn,$creneauxStructures, $creneauxAffiches,$minDebut,$minFin);
                    }  
                }else{
                    for($s= 1; $s <=date("W", mktime(0, 0, 0, 12,28, $a));$s++){
                        $this->generateForWeek($s,$a,$jn,$creneauxStructures, $creneauxAffiches,$minDebut,$minFin);
                    }  
                }
            }
        }
    }
    
    public function generateForWeek($s,$a,$jn,$creneauxStructures, $creneauxAffiches,$minDebut,$minFin){          
        $this->agendasYear->last()->addAgendaWeek(new AgendaWeek());
        $this->agendasYear->last()->getAgendasWeek()->last()->setVal($s); // Création d'une semaine d'agenda portant le numéro $s

        // Sur jn jours
        for($j=1; $j<=$jn;$j++){                
            $this->agendasYear->last()->getAgendasWeek()->last()->addAgendaDay(new AgendaDay());                                                
            $this->agendasYear->last()->getAgendasWeek()->last()
                                    ->getAgendasDay()->last()
                                        ->setMinuteDebut($minDebut);
            $this->agendasYear->last()->getAgendasWeek()->last()
                                    ->getAgendasDay()->last()
                                        ->setMinuteFin($minFin);
            $criteria = Criteria::create()
                    ->Where(Criteria::expr()
                                ->eq("jour",$j))
                    ->andWhere(Criteria::expr()
                                ->eq("annee",$a))
                    ->andWhere(Criteria::expr()
                                ->eq("semaine",$s))
                    ->orderBy(array("heureDebut"=>"ASC"));   
            $creneauxSelect = $creneauxStructures->matching($criteria);

            $this->agendasYear->last()->getAgendasWeek()->last()
                            ->getAgendasDay()->last()
                                ->init($j,$a,$s,$creneauxSelect,
                                                    $creneauxAffiches);  
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
