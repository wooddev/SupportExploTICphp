<?php
namespace Explotic\AgendaBundle\Generateurs;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreneauRdvGen
 *
 * @author Arraiolos adrien
 *  
 * 
 * 
 */
class CreneauRdvGen {
    private $creneauxModeles;
    private $week;
    private $year;
    private $dateDebut;
    private $dateFin;
    private $creneauxRdvs;
    
    /**
     * init 
     * 
     * constructeur de la classe CreneauRdvGen
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $creneauxModeles
     * @param integer $week
     * @param integer $year
     */ 

    
    public function __construct(){
        $this->creneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
    }
    
    public function init( $creneauxModeles, $dateDebut, $dateFin){
        
        $this->creneauxModeles = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach($creneauxModeles as $creneauModele){
            $this->creneauxModeles->add($creneauModele);
        }
        $this->dateDebut = $dateDebut;
        $this->$dateDebut= $dateFin;    
        $this->creneauxRdvs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function setCreneauxModeles($creneauxModeles){                

        foreach($creneauxModeles as $creneauModele){
            $this->creneauxModeles->add($creneauModele);
        }
    }
    
    public function getWeek(){
        return $this->week;
    }
    public function getYear(){
        return $this->year;
    }
    public function setWeek($week){
        $this->week = $week;
        return $this;
    }
    public function setYear($year){
        $this->year = $year;
        return $this;
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
        
    public function getCreneauxRdvs(){
        return $this->creneauxRdvs;
    }
    
    /**
     * 
     */
    
    public function generateCreneauxRdvs(\Explotic\AgendaBundle\Entity\CreneauRdvRepository $repo){
        
        $semaineDebut = $this->dateDebut->format('W');
        $anneeDebut = $this->dateDebut->format('Y');
        $semaineFin = $this->dateFin->format('W');
        $anneeFin = $this->dateFin->format('Y');
        
        if($anneeDebut == $anneeFin){
            for($s=$semaineDebut; $s <=$semaineFin;$s++){
                $this->generateForWeek($s,$anneeDebut, $repo);
            } 
            
        }else{        
            for ($a = $anneeDebut; $a <= $anneeFin ; $a++){
                if ($a == $anneeDebut){
                    for($s= $semaineDebut; $s <=date("W", mktime(0, 0, 0, 12, 28, $a));$s++){
                        $this->generateForWeek($s,$a, $repo);
                    }            
                }
                elseif ($a == $anneeFin){
                    for($s=1 ; $s <=$semaineFin;$s++){
                        $this->generateForWeek($s,$a,$repo);
                    }  
                }else{
                    for($s= 1; $s <=date("W", mktime(0, 0, 0, 12, 28, $a));$s++){
                        $this->generateForWeek($s,$a,$repo);
                    }  
                }
            }
        }
    }
    
    public function generateForWeek($s,$a,  \Explotic\AgendaBundle\Entity\CreneauRdvRepository $repo){      
        foreach($this->creneauxModeles as $creneauModele){
            if(count($repo->testExist($s,$a,$creneauModele->getJour()))==0){
                $this->creneauxRdvs->add(new \Explotic\AgendaBundle\Entity\CreneauRdv());
                $this->creneauxRdvs->last()->setDuree($creneauModele->getDuree());
                $this->creneauxRdvs->last()->setHeure($creneauModele->getHeure());
                $this->creneauxRdvs->last()->setMinute($creneauModele->getMinute());
                $this->creneauxRdvs->last()->setHeureDebut($creneauModele->getHeureDebut());
                $this->creneauxRdvs->last()->setHeureFin($creneauModele->getHeureFin());
                $this->creneauxRdvs->last()->setJour($creneauModele->getJour());
                $this->creneauxRdvs->last()->setAnnee($a);
                $this->creneauxRdvs->last()->setSemaine($s);   
                $this->creneauxRdvs->last()->calculDateTime(); 
            }
            
        }   
    }
   
}

?>
