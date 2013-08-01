<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\Rdv;
use Transfer\ReservationBundle\Form\RdvType;
use Transfer\ReservationBundle\Entity\Evenement;
/**
 * Rdv controller.
 *
 */
class RdvController extends Controller implements VidangeRequiseController
{
    /**
     * Lists all Rdv entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:Rdv')->findAll();

        return $this->render('TransferReservationBundle:Rdv:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    public function showTransporteurAction($annee,$semaine){
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
        $em = $this->getDoctrine()->getManager();        
        
        $transporteur = $this->get('transfer_profil.acces')->getTransporteur();
        $rdvs_provisoire = $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findByStatutRdv($transporteur,$annee,$semaine,'provisoire');
        $rdvs_confirmes = $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findByStatutRdv($transporteur,$annee, $semaine,'confirme');     

        return $this->render('TransferReservationBundle:Rdv:show/reservations.html.twig', array(
            'provisoires'=>$rdvs_provisoire,
            'confirmes'      => $rdvs_confirmes,
            ));      
        
    }
    
    public function showAgendaTransporteurAction($annee, $semaine)
    {
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
        $em = $this->getDoctrine()->getManager();        
        
        $transporteur = $this->get('transfer_profil.acces')->getTransporteur();
       
        $postes = $em->getRepository('TransferReservationBundle:TypePoste')->findall();
        
        $agendas = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($postes as $poste){
            $rdvs = new \Doctrine\Common\Collections\ArrayCollection(
                        $em->getRepository('TransferReservationBundle:Rdv')
                                        ->findByTransporteur_Annee_Semaine_Poste(
                                                $transporteur,$annee,$semaine,$poste));
       
            $creneauRdvs = new \Doctrine\Common\Collections\ArrayCollection(
                                $em->getRepository('TransferReservationBundle:CreneauRdv')
                                            ->findByAnnee_Semaine_Poste(
                                                    $annee,$semaine,$poste));
            $minutesMin = new \DateTime($em->getRepository('TransferReservationBundle:Rdv')
                                            ->findSemaineMinutesMin(
                                                    $annee,$semaine,$poste));            
            $min = (int)$minutesMin->format('H')*60 + (int)$minutesMin->format('i')-15;
            if($creneauRdvs){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init($semaine,$annee,$poste);
                $agendas->last()->generateAgenda($creneauRdvs,$rdvs, $min ,1200);                
            }
            else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
        }        
        return $this->render('TransferReservationBundle:Rdv:show/agenda.html.twig', array(
            'transporteur'=>$transporteur,
            'agendas'      => $agendas,
            ));        
    }

    /**
     * Finds and displays a Rdv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Rdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    public function planningJourShowAction(\DateTime $date){
        
        $agendas = $this->get('transfer.agenda_builder')->planningJourBuilder($date);
        $dayNum =(int) $date->format('N') -1;
       return $this->render('TransferReservationBundle:Rdv:show/agendaJour.html.twig', array(
            'agendas' => $agendas,
           'dayNum' => $dayNum,
            ));  
    }
    
    public function planningSemaineShowAction(\DateTime $date){
        
        $agendas = $this->get('transfer.agenda_builder')->planningSemaineBuilder($date);
       return $this->render('TransferReservationBundle:Rdv:show/agendaSemaine.html.twig', array(
            'agendas' => $agendas,
            ));  
    }
    
    public function acquittementShowAction($rdvId){
        
    }
    
    /**
     * Finds and displays a Rdv entity.
     *
     */
    public function show2Action($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Rdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Rdv entity.
     *
     */
    public function newAction()
    {
        $entity = new Rdv();
        $form   = $this->createForm(new RdvType(), $entity);

        return $this->render('TransferReservationBundle:Rdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Rdv entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Rdv();
        $form = $this->createForm(new RdvType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:Rdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Rdv entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $editForm = $this->createForm(new RdvType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Rdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Rdv entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RdvType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:Rdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Rdv entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rdv entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rdv'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Méthode éxécutée après soumission du formulaire de recherche par l'utilisateur
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
    
    public function reservationRechercheAction(Request $request){
        
        $rdvRecherche = new \Transfer\ReservationBundle\Recherche\RdvRecherche();
        $form = $this->createForm(new \Transfer\ReservationBundle\Form\CreneauRdvRechercheType(), $rdvRecherche);
        
        //Intégration du contenu du formulaire dans le rdvRecherche
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();       
                        
            ////////////// CONTROLE DES QUOTAS ///////////////////////   
//            $autorisation = $em->getRepository('TransferProfilBundle:Transporteur')
//                                ->testAutorisation($rdvRecherche->getAnnee(),
//                                        $rdvRecherche->getSemaine(),1); //!!!! Transporteur 1 pour l'instant !!!
//            
//            if($autorisation <1){
//                return $this->render('TransferReservationBundle:CreneauRdv:recherche/quota.html.twig'); 
//            }
            ////////////////////////////////////////////////////////////
            
            //Conversion des Année-semaine-jour-heure en DateTime
            $rdvRecherche->calculDateTime();
            
            //Définition de la plage de recherche à partir du paramètres fixé dans l'objet de paramétrage
            $dateHeureDebut = clone $rdvRecherche->getDateHeureDebut();
            $dateHeureDebut->sub(new \DateInterval($this->get('transfer_reservation.parametres')->getIntervalleRecherche()));
            $dateHeureFin = clone $rdvRecherche->getDateHeureDebut();
            $dateHeureFin->add(new \DateInterval($this->get('transfer_reservation.parametres')->getIntervalleRecherche()));            
            
            
            
            return $this->reservation($rdvRecherche,$dateHeureDebut,$dateHeureFin,$em);

        }
        else{return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');}
    }
        
    public function confirmationAction($id){
        $em=$this->getDoctrine()->getManager();
        
        $rdvConfirme= $em->getRepository('TransferReservationBundle:Rdv')
                                ->find($id);
        $transporteur = $this->get('transfer_profil.acces')->getTransporteur();
        
        $rdvConfirme->setStatutRdv('confirme');
        $evenement = new Evenement();
        $evenement->setTransporteur($transporteur);
        $evenement->setRdv($rdvConfirme);
        $evenement->setType('confirmation');
        $em->persist($rdvConfirme);
        $em->persist($evenement);
        $em->flush();
        return $this->redirect($this->generateUrl(
                'rdv_transporteur',
                array('annee' =>  $rdvConfirme->getAnnee(),
                      'semaine'=> $rdvConfirme->getSemaine())                                                                                                                              
        ));
        
    }
    public function reservationProcheAction($mode, $idRdv){
              
        $em= $this->getDoctrine()->getManager();
        $rdvEnCours = $em->getRepository('TransferReservationBundle:Rdv')->find($idRdv);
        $CreneauEnCours = $rdvEnCours->getCreneauRdv();
        $rdvRecherche = new \Transfer\ReservationBundle\Recherche\RdvRecherche();
        $rdvRecherche->setDateHeureDebut($CreneauEnCours->getDateHeureDebut());
        $rdvRecherche->setDateHeureFin($CreneauEnCours->getDateHeureFin());
        $rdvRecherche->setTypeCamion($rdvEnCours->getTypeCamion());

        //Définition de la plage de recherche à partir du paramètres fixé dans l'objet de paramétrage
        $dateHeureDebut = clone $CreneauEnCours->getDateHeureDebut();
        $dateHeureFin = clone $CreneauEnCours->getDateHeureDebut();        
        switch($mode){
            case "suivant":
                $dateHeureFin->add(new \DateInterval($this->get('transfer_reservation.parametres')->getIntervalleRecherche()));  
                break;
            case "precedent":
                $dateHeureDebut->sub(new \DateInterval($this->get('transfer_reservation.parametres')->getIntervalleRecherche()));  
                break;
        }
        
        return $this->reservation($rdvRecherche,$dateHeureDebut,$dateHeureFin,$em);;
    }    
    
    /**
     * Méthode du controller qui appelle le service de réservation (moteurReservation)
     * @param type $resultatsTries
     * @param type $typeCamion
     * @return type
     */
    
    public function reservation($rdvRecherche,$dateHeureDebut, $dateHeureFin,$em){
        //Mise à jour des disponibilités sur la plage de recherche
         $this->get('transfer_reservation.reservation')->fixDisponibilites(
                        $em->getRepository('TransferReservationBundle:CreneauRdv')
                            ->findByPeriod($dateHeureDebut,$dateHeureFin), 
                        array('persist'=>true));

        //Récupération des créneaux disponibles dans la plage recherchée          
        $creneauxRdvBruts = $em->getRepository('TransferReservationBundle:CreneauRdv')
                                ->findByRecherche($rdvRecherche,$dateHeureDebut,$dateHeureFin);
        if ($creneauxRdvBruts == null){
            return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
        }

        //Construction d'une collection afin de pouvoir trier les créneaux
        $resultatsTries = new \Transfer\MainBundle\Model\Sorter();
        foreach ($creneauxRdvBruts as $creneauRdvBrut){    
            //Encapsulation des créneaux dans un objet RdvResultat (pour faire les opérations de tri)
            $resultatsTries->add(new \Transfer\ReservationBundle\Recherche\RdvResultatAsso($creneauRdvBrut,$rdvRecherche));            
        }

        $resultatsTries->sortArray('getDiffTemps');
        foreach ($resultatsTries as $resultat){            
            if($this->get('transfer_reservation.reservation')->reservation(
                            $resultat->getCreneauRdv(),
                            $rdvRecherche->getTypeCamion(),
                            $this->get('transfer_profil.acces')->getTransporteur(),
                            array('vidange'=>true))
                    )
                {
                return $this->redirect($this->generateUrl(
                        'rdv_transporteur',
                        array(
                              'annee' =>  $resultat->getCreneauRdv()->getAnnee(),
                              'semaine'=> $resultat->getCreneauRdv()->getSemaine())                                                                                                                              
                ));
            }
        }  
        return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
    } 
    
       
//    public function rechercheCreneauxRdv($date,$periode){
//        //Récupération des créneaux disponibles dans la plage recherchée
//        $creneauxRdvBruts = $em->getRepository('TransferReservationBundle:CreneauRdv')
//                                ->findByRecherche($rdvRecherche);
//        if ($creneauxRdvBruts == null){
//            return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
//        }
//
//        //Construction d'une collection afin de pouvoir trier les créneaux
//        $creneauxRdvTries = new \Transfer\MainBundle\Model\Sorter();
//        foreach ($creneauxRdvBruts as $creneauRdvBrut){    
//            //Encapsulation des créneaux dans un objet RdvResultat (pour faire les opérations de tri)
//            $creneauxRdvTries->add(new \Transfer\ReservationBundle\Recherche\RdvResultat($creneauRdvBrut,$rdvRecherche));            
//        }
//
//        $creneauxRdvTries->sortArray('getDiffTemps');
//
//        return $this->reservation($creneauxRdvTries,$rdvRecherche->getTypeCamion()); 
//    }
    
    
}