<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Generateurs\CreneauPrefGen;
use Transfer\ReservationBundle\Form\CreneauPrefGenType;

/**
 * CreneauPref controller
 *
 */
class CreneauPrefGenController extends Controller
{
    public function selectTypeCamionAction(){
        $entity = new \Transfer\ReservationBundle\Generateurs\TypeCamionSelector();
        $form = $this->createForm(new \Transfer\ReservationBundle\Form\SelectTypeCamionType(),$entity);
        
        return $this->render('TransferReservationBundle:CreneauPref:selecttypecamion.html.twig', array(
            'form' => $form->createView(),
            ));
    }    
    
    /**
     * Récupère le type de camion choisi par l'utilisateur (mode AJAX)
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     * @throws \Exception
     */
    
    public function generateAjaxAction(Request $request){
        $entity = new \Transfer\ReservationBundle\Generateurs\TypeCamionSelector();
        $form = $this->createForm(new \Transfer\ReservationBundle\Form\SelectTypeCamionType(),$entity);
        $form->bind($request);
        if(!($form->isValid())){
            throw new \Exception();
        }        
        return $this->generateAction($entity->getTypeCamion()->getId());
    }
    
    
    /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction($typeCamionId)
    {           
        
        $em = $this->getDoctrine()->getManager();  
        
        $typeCamion = $em->getRepository('TransferReservationBundle:TypeCamion')
                            ->find($typeCamionId);
        //On utilise la classe creneauPrefGen pour concevoir le formulaire de création des créneaux prefs
        $generateur = $this->get('transfer_reservation.generateur.creneau_pref');    
        
        $generateur->setTypeCamion($typeCamion);
        
        $generateur->setEtatReservation($em->getRepository('TransferReservationBundle:EtatReservation')
                                        ->findByNom('A réserver'));
        $generateur->setStatut($em->getRepository('TransferReservationBundle:StatutCreneau')
                                        ->findByNom('Actif'));       
        
        $formType = new CreneauPrefGenType();
        //Construction de l'agenda servant de support d'affichage des créneaux modèles dans le formulaire
        $agendas= $this->buildAgendas($em,$typeCamion);
        $formType->setAgendas($agendas);
        $form = $this->createForm($formType, $generateur);     
        
        return $this->render('TransferReservationBundle:CreneauPref:generate.html.twig', array(
            'generateur' => $generateur,
            'agendas' => $agendas,
            'typecamion'=>$typeCamion,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new CreneauRdv Collection
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
      
        $generateur = $this->get('transfer_reservation.generateur.creneau_pref');    
        $form = $this->createForm(new CreneauPrefGenType(), $generateur);
        $form->bind($request);
        
        $etat= $em->getRepository('TransferReservationBundle:EtatReservation')
                        ->findByNom('A réserver');
        $statut = $em->getRepository('TransferReservationBundle:StatutCreneau')
                        ->findByNom('Actif');
        
        $generateur->setEtatReservation($etat[0]);
        $generateur->setStatut($statut[0]);
        if ($form->isValid()){           
            $generateur->reserver();             
        }                
        return $this->redirect($this->generateUrl('creneauprefgen_selecttypecamion'));   
    }
    
    public function buildAgendas($em, $typeCamion){
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
       
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
}
