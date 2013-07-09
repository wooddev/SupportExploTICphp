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
         /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $generateur = new CreneauPrefGen();
        
        $generateur->setEtatReservation($em->getRepository('TransferReservationBundle:EtatReservation')
                                        ->findByNom('A réserver'));
        $generateur->setStatut($em->getRepository('TransferReservationBundle:StatutCreneau')
                                        ->findByNom('Actif'));        
        
             
         
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
       
        $postes = $em->getRepository('TransferReservationBundle:TypePoste')->findall();
        
        $agendas = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($postes as $poste){
            $creneauxStructure = new \Doctrine\Common\Collections\ArrayCollection(
                        $em->getRepository('TransferReservationBundle:creneauModele')
                                        ->findActifsByPoste($poste));
       
            $creneauxAffiches = new \Doctrine\Common\Collections\ArrayCollection(
                                $em->getRepository('TransferReservationBundle:CreneauPref')
                                            ->findActifsByPoste($poste));
            $minutesMin = new \DateTime($em->getRepository('TransferReservationBundle:creneauModele')
                                            ->findSemaineMinutesMin($poste));            
            $min = (int)$minutesMin->format('H')*60 + (int)$minutesMin->format('i')-15;
            if($creneauxStructure){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init(10,1980,$poste,1);
                $agendas->last()->generateAgenda($creneauxStructure,$creneauxAffiches, $min ,1200);                
            }
            else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
        }      
         
        $formType = new CreneauPrefGenType();
        $formType->setAgendas($agendas);
        $form = $this->createForm($formType, $generateur);     
        
        return $this->render('TransferReservationBundle:CreneauPref:generate.html.twig', array(
            'generateur' => $generateur,
            'agendas' => $agendas,
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

        
//        Version sans formulaire, à partir du constructeur modifié
//        $posteAutonome = $em->getRepository('TransferReservationBundle:TypePoste')->find(1);
//        $generateur  = new CreneauModeleGen(6,0, 0, 19, 20,$posteAutonome->getDisponibilite() , $posteAutonome);                
// 
        
        
        $generateur = new CreneauRdvGen();
        $form = $this->createForm(new CreneauRdvGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){            
           

            $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            
            $generateur->generateCreneauxRdvs(); 
            
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                $em->persist($creneauRdv);
            }        
            $em->flush();  
        }
       
        return $this->render('TransferReservationBundle:CreneauRdv:index.html.twig', array(
            'entities'      => $generateur->getCreneauxRdvs()
        ));
    }
}
