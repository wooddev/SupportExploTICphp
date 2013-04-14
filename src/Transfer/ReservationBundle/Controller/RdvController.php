<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\Rdv;
use Transfer\ReservationBundle\Form\RdvType;
use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ReservationBundle\Entity\Evenement;

/**
 * Rdv controller.
 *
 */
class RdvController extends Controller
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
    
    public function showTransporteurAction($annee, $semaine)
    {
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
        $em = $this->getDoctrine()->getManager();
        
        //Récupération du transporteur associé à l'utilisateur
        $user = $this->container->get('security.context')->getToken()->getUser();
        if(! is_object($user))
        {
            return new \Symfony\Component\HttpFoundation\Response('Veuillez vous authentifier');          
        }     
        
        if(!(is_object($user->getAgentTrsp()))){
            return new \Symfony\Component\HttpFoundation\Response("
                L'administrateur doit relier votre compte à une entreprise de transport");          
        }   
        $transporteur = $user->getAgentTrsp()->getTransporteur();
        /////////////////////////////////////////////////////
       
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
            
            if($creneauRdvs){
                $agendas->add( new \Transfer\MainBundle\Model\Agenda());
                $agendas->last()->init($semaine,$annee,$poste);
                if ($poste->getNom() == 'Fond mouvant'){
                    $agendas->last()->generateAgenda($creneauRdvs,$rdvs,350 ,1200);
                }else{
                    $agendas->last()->generateAgenda($creneauRdvs,$rdvs, 280 ,1200);
                }
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
    
    public function reservationAction(Request $request){
        
        $rdvRecherche = new CreneauRdv();
        $form = $this->createForm(new \Transfer\ReservationBundle\Form\CreneauRdvRechercheType(), $rdvRecherche);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();       
                        
            ////////////// CONTROLE DES QUOTAS ///////////////////////   
            $autorisation = $em->getRepository('TransferProfilBundle:Transporteur')
                                ->testAutorisation($rdvRecherche->getAnnee(),
                                        $rdvRecherche->getSemaine(),1); //!!!! Transporteur 1 pour l'instant !!!
            
            if($autorisation <1){
                return $this->render('TransferReservationBundle:CreneauRdv:recherche/quota.html.twig'); 
            }
            ////////////////////////////////////////////////////////////
            
            $rdvRecherche->calculDateTime();
                    
            $creneauxRdvBruts = $em->getRepository('TransferReservationBundle:CreneauRdv')
                                    ->findByRecherche($rdvRecherche);
            if ($creneauxRdvBruts == null){
                return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
            }
            $creneauxRdvTries = new \Transfer\MainBundle\Model\Sorter();

            foreach ($creneauxRdvBruts as $creneauRdvBrut){
                $creneauxRdvTries->add(new \Transfer\ReservationBundle\Recherche\RdvResultat($creneauRdvBrut,$rdvRecherche));            
            }

            //Récupération du transporteur associé à l'utilisateur
            $user = $this->container->get('security.context')->getToken()->getUser();
            if(! is_object($user))
            {
                return new \Symfony\Component\HttpFoundation\Response('Veuillez vous authentifier');          
            }     

            if(!(is_object($user->getAgentTrsp()))){
                return new \Symfony\Component\HttpFoundation\Response("
                    L'administrateur doit relier votre compte à une entreprise de transport");          
            }   
            $transporteur = $user->getAgentTrsp()->getTransporteur();
            //////////////////////////////////////////////////////////////
            foreach ($creneauxRdvTries->sortArray('getDiffTemps') as $creneauRdv){
                $creneauRdvSync = $em->getRepository('TransferReservationBundle:CreneauRdv')                    
                                            ->find($creneauRdv->getId());

                if ($creneauRdvSync->getDisponibilite() > 0){
                    //On bloque le créneau tout de suite
                    $creneauRdvSync->setDisponibilite($creneauRdvSync->getDisponibilite()-1);
                    $em->persist($creneauRdvSync);
                    $em->flush();         
                    
                    //Vidange du panier
                    //Recherche de rdv provisoires existants 
                    $provisoires = $em->getRepository('TransferReservationBundle:Rdv')
                                            ->findByStatutRdv('provisoire');
                    //suppression des provisoires existants
                    if($provisoires){
                        foreach ($provisoires as $provisoire){
                            $em->remove($provisoire);
                        }
                        $em->flush(); 
                    }                    
                    // création du rdv recherché
                    $rdv = new \Transfer\ReservationBundle\Entity\Rdv();
                    $rdv->init($creneauRdvSync);
                    // Création de l'évenement de réservation
                    $evenement = new Evenement();
                    $evenement->setRdv($rdv);
                    $evenement->setTransporteur($transporteur);
                    $evenement->setType('reservation');
                    $em->persist($rdv);
                    $em->persist($evenement);
                    $em->flush();
                    return $this->redirect($this->generateUrl(
                            'rdv_transporteur',
                            array(
                                  'annee' =>  $rdvRecherche->getAnnee(),
                                  'semaine'=> $rdvRecherche->getSemaine())                                                                                                                              
                    ));
                }
            }
        }
        return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
    }
    
    public function confirmationAction($id){
        $em=$this->getDoctrine()->getManager();
        
        $rdvConfirme= $em->getRepository('TransferReservationBundle:Rdv')
                                ->find($id);
        $transporteur = $em->getRepository('TransferProfilBundle:Transporteur')
                                    ->find(1);
        
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
}