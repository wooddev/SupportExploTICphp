<?php
namespace Explotic\AgendaBundle\Model;

use Explotic\PlanningBundle\Entity\CalendrierRepository;
use Explotic\AgendaBundle\Entity\TypeRdvRepository;
use Explotic\AgendaBundle\Entity\CreneauRdvRepository;
use Explotic\PlanningBundle\Services\AgendaGenerator;
    

/**
 * Description of RdvSelector
 *
 * @author arraiolosa
 */
class RdvSelector {
    //put your code here
    private $calendriersListe;
    
    private $creneauxRdvsId;
    private $calendrierId;
    private $agenda;
    private $statutsRdv;
    private $typesRdvs;   
    private $agendaGenerator;
 
    private $calendrierRepository;
    private $creneauRdvRepository;

    public function __construct(TypeRdvRepository $typeRdvRepository,
                                CreneauRdvRepository $CreneauRdvRepository,
                                CalendrierRepository $calendrierRepository,
                                AgendaGenerator $agendaGenerator) 
    {
        $this->typesRdvs = $typeRdvRepository->findAll();
        $this->creneauRdvRepository = $CreneauRdvRepository;
        $this->calendrierRepository = $calendrierRepository;   
        $this->agendaGenerator = $agendaGenerator;
    }
    
    
    /**
     * 
     * @param type $dateDebut
     * @param type $dateFin
     * @param type $options 
     * ## VALEURS ACCEPTEES POUR OPTIONS ##
     * - type : stagiaire, bureau, poste, salle, formateur, session
     * - id (de l'entité associée au calendrier)
     */
    public function generateSelector(\DateTime $dateDebut,$nbSemaines,$options){
        $interval = new \DateInterval("P".$nbSemaines.'W');
        $dateFin = clone $dateDebut;
        $dateFin->add($interval);
        
        $creneauxRdvs = $this->creneauRdvRepository->findByPeriod($dateDebut, $dateFin);
        foreach($creneauxRdvs as $creneauRdv){
            $this->creneauxRdvsId[]=$creneauRdv->getId();
        }
        $this->calendriersListe = $this->calendrierRepository->findByOptions($options);   
        
        $this->calendrierId = $this->calendriersListe[0]['id'];
        
        $this->agenda = $this->agendaGenerator->makeAgenda($this->calendriersListe, $dateDebut->getTimestamp(), $nbSemaines);
        
        $this->statutsRdv = array('provisoire'=>'Provisoire','confirme'=>'Confirme');
        
        return $this;
    }    
    
    public function getCalendriersListe() {
        return $this->calendriersListe;
    }

    public function setCalendriersListe($calendriersListe) {
        $this->calendriersListe = $calendriersListe;
    }

    public function getCreneauxRdvs() {
        return $this->creneauxRdvs;
    }

    public function setCreneauxRdvs($creneauxRdvs) {
        $this->creneauxRdvs = $creneauxRdvs;
    }
    
    public function getCalendrierId() {
        return $this->calendrierId;
    }

    public function setCalendrierId($calendrierId) {
        $this->calendrierId = $calendrierId;
    }

    
    public function getAgenda() {
        return $this->agenda;
    }

    public function setAgenda($agenda) {
        $this->agenda = $agenda;
    }

    public function getTypesRdvs() {
        return $this->typesRdvs;
    }

    public function setTypesRdvs($typesRdvs) {
        $this->typesRdvs = $typesRdvs;
    }   
        
}

?>
