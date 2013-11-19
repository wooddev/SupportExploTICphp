<?php
namespace Explotic\PlanningBundle\Generateur;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionGenerator
 *
 * @author adrien
 */
class SessionGenerator {
    
    private 
            $numero,
            $module,
            $dateDebut,
            $salle,
            $stagiaires,
            $formateursSalle ,
            $session            
            ;
    public function __construct() {
                
        $this->stagiaires = new Doctrine\Common\Collections\ArrayCollection();
        $this->formateursSalle = new Doctrine\Common\Collections\ArrayCollection();
        
    }
    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getModule() {
        return $this->module;
    }

    public function setModule(\Explotic\FormationBundle\Entity\Module $module) {
        $this->module = $module;
    }
    
    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }
    
    public function getSalle() {
        return $this->salle;
    }

    public function setSalle(\Explotic\TiersBundle\Entity\Salle $salle) {
        $this->salle = $salle;
    }
        
    public function getStagiaires() {
        return $this->stagiaires;
    }
    
    public function addStagiaire($stagiaire){
        $this->stagiaires->add($stagiaire);
    }

    public function setStagiaires(Explotic\TiersBundle\Entity\Stagiaire $stagiaires) {
        $this->stagiaires = $stagiaires;
    }

    public function getFormateursSalle() {
        return $this->formateursSalle;
    }
    
    public function addFormateurSalle(Explotic\TiersBundle\Entity\Formateur $formateur) {
        $this->formateursSalle->add($formateur);
    }

    public function setFormateursSalle($formateursSalle) {
        $this->formateursSalle = $formateursSalle;
    }

    public function getSession() {
        return $this->session;
    }

    public function setSession(Explotic\PlanningBundle\Entity\Session $session) {
        $this->session = $session;
    }

        
    public function generate(){
        $session = new Explotic\PlanningBundle\Entity\Session();
        
        $session->setDateDebut($this->dateDebut);
        
        $session->setModule($this->module);
        
        $session->setNumero($this->numero);
        
        foreach($session->getModule()->getInterventionSalles() as $interventionSalle){            
            $session->addSessionHasInterventionSalle(new Explotic\PlanningBundle\Entity\SessionHasInterventionSalle());
            $session->getSessionHasInterventionSalles()->last()->setIntervention($interventionSalle);  
            $session->getSessionHasInterventionSalles()->last()->setSalle($this->salle);  
            
            foreach($this->stagiaires as $stagiaire){
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->addInterventionHasStagiaires(new Explotic\PlanningBundle\Entity\InterventionHasStagiaire());
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->getInterventionHasStagiaires()
                                    ->last()->setStagiaire($stagiaire);                
            }
            foreach($this->formateursSalle as $formateur){
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->addInterventionHasFormateurs(new Explotic\PlanningBundle\Entity\InterventionHasFormateur());
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->getInterventionHasFormateurs()
                                    ->last()->setFormateur($formateur);                
            } 
        }
        
        foreach($session->getModule()->getInterventionEntreprises() as $interventionEntreprise){       
            foreach($this->stagiaires as $stagiaire){
                $session->addSessionHasInterventionEntreprise(new Explotic\PlanningBundle\Entity\SessionHasInterventionEntreprise());
                $session->getSessionHasInterventionEntreprises()->last()->setIntervention($interventionEntreprise);                          
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->addInterventionHasStagiaires(new Explotic\PlanningBundle\Entity\InterventionHasStagiaire());
                $session->getSessionHasInterventionSalles()
                            ->last()
                                ->getInterventionHasStagiaires()
                                    ->last()->setStagiaire($stagiaire);                
                if(!$stagiaire->getPostes()->isEmpty()){
                    $session->getSessionHasInterventionEntreprises()->last()->setPoste($stagiaire->getPostes()->last());
                }                    
            }
        }
        
        $this->setSession($session);
        
        return $session;        
        
    }

}

?>
