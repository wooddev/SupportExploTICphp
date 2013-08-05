<?php

namespace Transfer\MainBundle\Services;


/**
 * Description of AgendaBuilder
 *
 * @author adarr
 */
class AgendaBuilder {
    private $em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }
    
    public function creneauPrefBuilder($typeCamion){
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
       $em=  $this->em;
        $postes = $em->getRepository('TransferReservationBundle:TypePoste')->findall();
        
        $agendas = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($postes as $poste){
            $creneauxStructure = new \Doctrine\Common\Collections\ArrayCollection(
                        $em->getRepository('TransferReservationBundle:CreneauModele')
                                        ->findActifsByPoste($poste));
            
            $this->get('transfer_reservation.reservation')->fixDisponibilites($creneauxStructure,array('persist'=>true));
            
            $creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection(
                                $em->getRepository('TransferReservationBundle:CreneauPref')
                                            ->findActifsByPoste($poste));
            $minutesMin = new \DateTime($em->getRepository('TransferReservationBundle:CreneauModele')
                                            ->findSemaineMinutesMin($poste));            
            $min = (int)$minutesMin->format('H')*60 + (int)$minutesMin->format('i')-15;
            if($creneauxStructure){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init(1,1980,$poste,1);
                $agendas->last()->generateAgenda($creneauxStructure,$creneauxAffiches, $min ,1200);   
                $calculator = new \Transfer\ReservationBundle\Services\SelectableCalculator();
                $calculator->calculate($agendas->last(), $typeCamion);                
            }
            else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
        } 
        return $agendas;
    }
   
    public function planningJourBuilder(\DateTime $date){
        $em=  $this->em;
        
        $annee = (int) $date->format('Y');
        $semaine = (int) $date->format('W');
        $jour = (int) $date->format('N');
        
        
        $postes = $em->getRepository('TransferReservationBundle:TypePoste')->findall();
        
        $statutActif = $em->getRepository('TransferReservationBundle:StatutCreneau')
                                ->findOneByNom('Actif');
        
        $agendas = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($postes as $poste){
            $creneauxStructure = new \Doctrine\Common\Collections\ArrayCollection(
                        $em->getRepository('TransferReservationBundle:creneauRdv')
                                        ->findBy(array(
                                            'typePoste'=>$poste->getId(),
                                            'annee'=>$annee,
                                            'semaine'=>$semaine,
                                            'jour'=>$jour,  
                                            'statut'=>$statutActif->getId(),
                                            )));
            
            $creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection(
                                $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findByJourPoste($poste,$annee,$semaine,$jour,'confirme'));
            $minutesMin = new \DateTime($em->getRepository('TransferReservationBundle:CreneauModele')
                                            ->findSemaineMinutesMin($poste));            
            $min = (int)$minutesMin->format('H')*60 + (int)$minutesMin->format('i')-15;
            if($creneauxStructure){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init($semaine,$annee,$poste,1);
                $agendas->last()->generateAgenda($creneauxStructure,$creneauxAffiches, $min ,1200);                
            }
            else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
        } 
        return $agendas;
    }
    
    
    public function planningSemaineBuilder(\DateTime $date){
        $em=  $this->em;
        
        $annee = (int) $date->format('Y');
        $semaine = (int) $date->format('W');
        $jour = (int) $date->format('N');
        
        
        $postes = $em->getRepository('TransferReservationBundle:TypePoste')->findall();
        
        $statutActif = $em->getRepository('TransferReservationBundle:StatutCreneau')
                                ->findOneByNom('Actif');
        
        $agendas = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($postes as $poste){
            $creneauxStructure = new \Doctrine\Common\Collections\ArrayCollection(
                        $em->getRepository('TransferReservationBundle:creneauRdv')
                                        ->findBy(array(
                                            'typePoste'=>$poste->getId(),
                                            'annee'=>$annee,
                                            'semaine'=>$semaine,
                                            'statut'=>$statutActif->getId(),
                                            )));
            
            $creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection(
                                array_merge(
                                        $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findBySemainePoste($poste,$annee,$semaine,'confirme'),
                                        $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findBySemainePoste($poste,$annee,$semaine,'provisoire'))
                    );
            $minutesMin = new \DateTime($em->getRepository('TransferReservationBundle:CreneauModele')
                                            ->findSemaineMinutesMin($poste));            
            $min = (int)$minutesMin->format('H')*60 + (int)$minutesMin->format('i')-15;
            if($creneauxStructure){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init($semaine,$annee,$poste,1);
                $agendas->last()->generateAgenda($creneauxStructure,$creneauxAffiches, $min ,1200);                
            }
            else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
        } 
        return $agendas;
    }
    
    /**
     * Gestion des créneaux RDV
     * 
     * Service permettant de supprimer des créneaux Rdv
     * >> Système de checkbox pour sélectionner les créneaux à supprimer (inactivation)
     * 
     * >> les Rdv associés sont déplacés (nouvelle recherche sur les 2h autour)
     * 
     * @param type $semaine
     */
    
    public function creneauRdvBuilder($semaine){
        
    }
    /**
     * Gestion des créneaux Modeles
     * 
     * Service permettant de supprimer des créneaux Modeles
     * >> Système de checkbox pour sélectionner les créneaux à supprimer (Inactivation)
     * 
     * >> les créneaux prefs liés sont inactivés
     */
    public function creneauModeleBuilder(){
        
    }
    
    /**
     * Service permettant de gérer les rdv d'une semaine
     * 
     * Fonction par Rdv :
     * >> supprimer
     * >> Recherche du suivant/précédent/ nouvel horaire
     * 
     * @param type $semaine
     */
    
    public function rdvBuilder($semaine){
        
    }
    /**
     * Gestion des  Rdv par transporteurs
     * Affiche les Rdv
     * >> Permet la suppression
     * >> Recherche du suivant/précédent/ nouvel horair
     * @param type $semaine
     */
    public function transporteurRdvBuilder($semaine){
        
    }
}

?>
