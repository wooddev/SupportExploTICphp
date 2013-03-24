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
    
    public function generate($creneauxStructure, $creneauxAffiches, $nbSemaines){
        $year = $this->year;
        $week= $this->week;  
        $heureDebutJours = 5;

        //On créé un agenda pour l'année
        $agenda= new AgendaYear();
        $agenda->setVal((int)$year);
        // Le calendrier s'étale sur $nbSemaines
        for ($s = $week; $s<$week+$nbSemaines && $s<=52; $s++)
        {
            $agendaY1->addAgendaWeek(new AgendaWeek());
            $agendaY1->getAgendasWeek()->last()->setVal($s); // Création d'une semaine d'agenda portant le numéro $s
            
            // Sur 6 jours
            for($j=1; $j<=6;$j++)
            {                
                $agendaY1->getAgendasWeek()->last()->addAgendaDay(new AgendaDay());
                }
        }        
        $this->addAgendaYear($agendaY1);
        
        
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
    private $minuteDebut;
    private $minuteFin;
    private $dateTimeDebut;
    private $dateTimeFin;
    


    public function __construct(){         
        $this->creneaux = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setMinuteDebut($minuteDebut) {
        $this->minuteDebut = $minuteDebut;
        $this->dateTimeDebut= clone $this->date;
        $this->dateTimeDebut->setTime(floor($minuteDebut/60), 
                                      $minuteDebut-(floor($minuteDebut/60)*60),
                                      0);
    }

    public function getminuteFin() {
        return $this->minuteFin;
    }

    public function setminuteFin($minuteFin) {
        $this->minuteFin = $minuteFin;
        $this->dateTimeDebut= clone $this->date;
        $this->dateTimeDebut->setTime(floor($minuteFin/60), 
                                      $minuteFin-(floor($minuteFin/60)*60),
                                      0);
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
    
    public function init($j,$year,$s,$creneauxStructureJour, $creneauxAffichesJour){
        
        $this->setVal($j);// Création d'un jour d'agenda portant le numéro $s
        $this->setDate(new \DateTime());
        $this->getDate()->setISODate($year,$s,$j);
        

        //########Récupération des créneaux de structure dans l'agenda############
        //création d'un premier créneau vide
        $this->addCreneau(new AgendaCreneau());                    
        $this->getCreneaux()->last()
                            ->init(null,null,null,0,0,
                                    $this->getDateTimeDebut(),
                                    $creneauxStructureJour->first()->getHeureDebut(),
                                    'vide');

        // Parcours des créneaux de la collection
        foreach ($creneauxStructureJour as $creneau){
            //Si le créneau en cours ne suit pas directement le créneau précédent
            //cad encours(heure de début) != précédent(heure de fin)
            //==> création d'un créneau vide
            if($this->getCreneaux()->last()->getDateTimeFin()!=$creneau->getHeureFin()){
                $this->addCreneau(new AgendaCreneau());                    
                $this->getCreneaux()->last()->init(null,null,null,0,0,
                                            $this->getCreneaux()->last()->getDateTimeFin(),
                                            $creneau->getHeureDebut(),
                                            'vide');               
            }
            //Création et ajout d'une instance de creneauAgenda sur le modèle du créneau en cours
            $this->addCreneau(new AgendaCreneau());    
            $this->getCreneaux()->last()->init($creneau,null,null,
                                        $creneau->getDisponibilite(),0,
                                        $creneau->getHeureDebut(),
                                        $creneau->getHeureFin(),
                                        'structure');
        }

        // création du dernier créneau vide
        $this->addCreneau(new AgendaCreneau());                    
        $this->getCreneaux()->last()
                            ->init(null,null,null,0,0,
                                    $this->getCreneaux()->last()->getDateTimeFin(),
                                    $this->getDateTimeFin(),
                                    $this->getCreneaux()->last()->getMinuteDebut(),
                                    'vide');
        
        //########Récupération des créneaux affichés pour l'utilisateur dans l'agenda############
        // Parcours des créneaux de la collection
        foreach ($creneauxAffichesJour as $creneau){
            //Recherche du creneauAgenda associé et modification 
            //(on exploite le lien entre les classes de creneau)
            $creneauModeleCrit = Criteria::create()
                                ->where(Criteria::expr()->eq("creneauStructure",$creneau->getCreneauModele()));          
            $creneau = new \Transfer\ReservationBundle\Entity\CreneauPref();
            
            $this->getCreneaux()->matching($creneauModeleCrit)->first()
                                                ->setCreneauAffiche($creneau);
            $this->getCreneaux()->matching($creneauModeleCrit)->first()
                                                ->setTransporteur($creneau->getTransporteur());
            $this->getCreneaux()->matching($creneauModeleCrit)->first()
                                                ->setType('affiche');
        }
    }
    
}
class AgendaCreneau{
    private $val;
    private $creneauStructure;
    private $creneauAffiche;
    private $Transporteur;
    private $nbDisponibilites;
    private $nbAllouesTransporteur;
    private $dateTimeDebut;
    private $dateTimeFin;
    private $minuteDebut; // minutes de début et fin du créneau % à la journée
    private $duree;
    private $type;
            
    public function getCreneauStructure() {
        return $this->creneauStructure;
    }

    public function getCreneauAffiche() {
        return $this->creneauAffiche;
    }

    public function getTransporteur() {
        return $this->Transporteur;
    }

    public function getNbDisponibilites() {
        return $this->nbDisponibilites;
    }

    public function getNbAllouesTransporteur() {
        return $this->nbAllouesTransporteur;
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

    public function setIdCreneauAffiche($CreneauAffiche) {
        $this->creneauAffiche = $CreneauAffiche;
    }

    public function setIdTransporteur($Transporteur) {
        $this->Transporteur = $Transporteur;
    }

    public function setNbDisponibilites($nbDisponibilites) {
        $this->nbDisponibilites = $nbDisponibilites;
    }

    public function setNbAllouesTransporteur($nbAllouesTransporteur) {
        $this->nbAllouesTransporteur = $nbAllouesTransporteur;
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

        
    public function init($idCreneauStructure,$idCreneauAffiche,
                        $idTransporteur,$nbDisponibilites,
                        $nbAllouesTransporteur,
                        $dateTimeDebut,$dateTimeFin,$type)
    {
        $this->idCreneauStructure = $idCreneauStructure;
        $this->idCreneauAffiche = $idCreneauAffiche;
        $this->idTransporteur = $idTransporteur;
        $this->nbDisponibilites = $nbDisponibilites;
        $this->nbAllouesTransporteur = $nbAllouesTransporteur;
        $this->dateTimeDebut = $dateTimeDebut;
        $this->dateTimeFin = $dateTimeFin;
                
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
