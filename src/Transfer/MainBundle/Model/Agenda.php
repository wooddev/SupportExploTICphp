<?php
namespace Transfer\MainBundle\Model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use Doctrine\Common\Collections\Criteria;

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
    
    public function __construct(){         
        $this->agendasYear = new \Doctrine\Common\Collections\ArrayCollection();
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
   
    public function init($week,$year){
        
        $this->week = (int) $week;
        $this->year = (int) $year;
        
        $this->dateDebut = new \DateTime();
        $this->dateDebut->setISODate($this->year,$this->week);
        
        $this->dateFin = new \DateTime();
        if($week>48){ // gestion de la fin d'année ici aussi
            $this->dateFin->setISODate($this->year+1,$this->week+4-52);
        }else $this->dateFin->setISODate($this->year,$this->week+4); 
    }   
    
    public function generate($creneauxStructure, $creneauxAffiches){
        $year = $this->year;
        $week= $this->week;               

        //On créé un agenda pour l'année
        $agendaY1= new AgendaYear();
        $agendaY1->setVal((int)$year);
        // Le calendrier s'étale sur 4 semaines
        for ($s = $week; $s<$week+4 && $s<=52; $s++)
        {
            $agendaY1->addAgendaWeek(new AgendaWeek());
            $agendaY1->getAgendasWeek()->last()->setVal($s); // Création d'une semaine d'agenda portant le numéro $s
            
            foreach($creneauxStructure as $crStruct)
            {
                
            }

            // Sur 6 jours
            for($j=1; $j<=6;$j++)
            {                
                $agendaY1->getAgendasWeek()->last()->addAgendaDay(new AgendaDay());
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->setVal($j);// Création d'un jour d'agenda portant le numéro $s
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->setDate(new \DateTime());
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->getDate()->setISODate($year,$s,$j);
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->addCreneau(new Creneau());
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->getCreneaux()->last()->setVal("Mat");
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->addCreneau(new Creneau()); 
                $agendaY1->getAgendasWeek()->last()->getAgendasDay()->last()->getCreneaux()->last()->setVal("ApM");                  
            }
        }        
        $this->addAgendaYear($agendaY1);
        //On gère la fin d'année ici
        if($week>48)
        {
            $agendaY2= new AgendaYear();
            $agendaY2->setVal($year +1);
            for ($s = 1; $s<=$week+4-52; $s++)
            {
                $agendaY2->addAgendaWeek(new AgendaWeek());
                $agendaY2->getAgendasWeek()->last()->setVal($s); // Création d'une semaine d'agenda portant le numéro $s
                
                
                
                
                for($j=1; $j<=5;$j++)
                {
                    $agendaY2->getAgendasWeek()->last()->addAgendaDay(new AgendaDay());
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->setVal($j);// Création d'un jour d'agenda portant le numéro $s
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->setDate(new \DateTime());
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->getDate()->setISODate($year+1,$s,$j);
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->addCreneau(new Creneau());
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->getCreneaux()->last()->setVal("Mat");
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->addCreneau(new Creneau()); 
                    $agendaY2->getAgendasWeek()->last()->getAgendasDay()->last()->getCreneaux()->last()->setVal("ApM");                                          
                }
            } 
            $this->addAgendaYear($agendaY2);
        }
        
        // Calcul des dates de début et fin correspondate
        $dateDebut = new \DateTime();
        $dateDebut->setISODate($year,$week);
        
        $dateFin = new \DateTime();
        if($week>48){ // gestion de la fin d'année ici aussi
            $dateFin->setISODate($year+1,$week+4-52);
        }else $dateFin->setISODate($year,$week+4);       
        
        // On lie les jours récupérés au tableau des dates
        if(!(null===$jours))
        {
            foreach($jours as $jour)
            {
                $yearcrit = Criteria::create()
                        ->where(Criteria::expr()                
                                    ->eq("val",idate('Y',$jour->getCreneauDebut()->getTimeStamp())));                
                $weekcrit = Criteria::create()
                        ->where(Criteria::expr()
                                    ->eq("val",idate('W',$jour->getCreneauDebut()->getTimeStamp())));
                $daycrit = Criteria::create()
                        ->where(Criteria::expr()
                                    ->eq("val",idate('w',$jour->getCreneauDebut()->getTimeStamp())));
                $creneaucrit = Criteria::create()
                        ->where(Criteria::expr()
                                    ->eq("val",$jour->getCreneau()));                           
                $this->getAgendasYear()->matching($yearcrit)->first()
                        ->getAgendasWeek()->matching($weekcrit)->first()
                            ->getAgendasDay()->matching($daycrit)->first()
                                ->getCreneaux()->matching($creneaucrit)->first()
                                    ->setJour($jour);             
            }
        }
        
        return $this;
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

class AgendaDay{
    private $creneaux;
    private $val;
    private $date;
    
    
    public function __construct(){         
        $this->creneaux = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getCreneaux(){
        return $this->creneaux;
    }
    public function addCreneau($var){
        $this->creneaux->add($var);
        return $this;
    }
    
    public function getVal(){
        return $this->val;
    }
    public function setVal($var){
        $this->val = $var;
        return $this;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate($var){
        $this->date = $var;
        return $this;
    }
}
class Creneau{
    private $val;
    private $jour;
    
   public function getJour(){
        return $this->jour;
    }
    public function setJour($var){
        $this->jour=$var;
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

?>
