<?php

namespace Explotic\PlanningBundle\Services;

use Doctrine\ORM\EntityManager as EM;

/**
 * Description of AgendaGenerator
 *
 * @author arraiolos
 */
class AgendaGenerator {   
    
    private $em;
    
    public function __construct(EM $em) {
        $this->em = $em;
    } 
    /**
     * Finds and displays a calendrier's Agenda
     *
     */
    public function makeAgenda($calendrierListe,$dateDebut,$nbSemaines)
    {
        $em = $this->em;
              
        // Génération de l'agenda pour le mois en cours
        $agenda = new \Explotic\AgendaBundle\Model\Agenda();        
        $agenda->init((int) date('W', $dateDebut), (int) date('Y', $dateDebut),null,$nbSemaines); 
        
        // Récup des créneaux à intégrer à l'agenda
        $creneauxStructures = new \Doctrine\Common\Collections\ArrayCollection(
                $em->getRepository('ExploticAgendaBundle:CreneauRdv')
                    ->findByPeriod($agenda->getDateDebut(),$agenda->getDateFin())
                );   
        //Recherche des créneaux bloqués figurant dans cette partie du calendrier   
        $creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach($calendrierListe as $val ){
            $calendrierRdvs = $em->getRepository('ExploticAgendaBundle:Rdv')
                 ->findByPeriod($agenda->getDateDebut(),$agenda->getDateFin(),$val['id']); 
             foreach ($calendrierRdvs as $rdv){
                 $creneauAffiche = new \Explotic\AgendaBundle\Model\CreneauAffiche($rdv,$val['nom']);
                 $creneauxAffiches->add(clone $creneauAffiche);
             } 
        }
        

        $agenda->generateAgenda($creneauxStructures, $creneauxAffiches,420,1140);
                
        return $agenda;
    }     
}

?>
