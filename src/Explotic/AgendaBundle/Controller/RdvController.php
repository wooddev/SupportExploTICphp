<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\AgendaBundle\Entity\Rdv;
use Explotic\AgendaBundle\Form\RdvType;

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

        $entities = $em->getRepository('ExploticAgendaBundle:Rdv')->findAll();

        return $this->render('ExploticAgendaBundle:Rdv:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Rdv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAgendaBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticAgendaBundle:Rdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Rdv entity.
     *
     */
    public function newAction()
    {
        $entity  = new Rdv();
        
        $dateDebut = new \DateTime();
        $dateFin = new \DateTime();
        $interval= new \DateInterval('P1M');
        $dateFin->add($interval);
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        $form = $this->createForm(new RdvType($dateDebut,$dateFin,$user), $entity);
        
        return $this->render('ExploticAgendaBundle:Rdv:new.html.twig', array(
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

        return $this->render('ExploticAgendaBundle:Rdv:new.html.twig', array(
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

        $entity = $em->getRepository('ExploticAgendaBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $editForm = $this->createForm(new RdvType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticAgendaBundle:Rdv:edit.html.twig', array(
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

        $entity = $em->getRepository('ExploticAgendaBundle:Rdv')->find($id);

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

        return $this->render('ExploticAgendaBundle:Rdv:edit.html.twig', array(
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
            $entity = $em->getRepository('ExploticAgendaBundle:Rdv')->find($id);

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
    
    public function setSelectedRdvAction(){
        $rdvSelector = new \Explotic\AgendaBundle\Model\RdvSelector();
        $rdvSelector->setDateDebut(new \DateTime('now'));
        $rdvSelector->setPeriod('P6D');
        $rdvSelector->setBookingType('tiers');
        $formType = new \Explotic\AgendaBundle\Form\RdvSelectorType();
        $form = $this->createForm($formType, $rdvSelector);
        
        return $this->render('ExploticAgendaBundle:Rdv:new/selector.html.twig', array(
            'entity' => $rdvSelector,
            'form'   => $form->createView(),
        ));
        
        
        
    }
    
    public function newSelectedRdvAction(Request $request/*$agendaId,$bookingType,  \DateTime $dateDebut, $period */){
        
        $rdvSelector = new \Explotic\AgendaBundle\Model\RdvSelector();
        $form = $this->createForm(new \Explotic\AgendaBundle\Form\RdvSelectorType(), $rdvSelector);
        
        $form->bind($request);

        if ($form->isValid()) {
        
            $em = $this->getDoctrine()->getEntityManager();

            $agenda = $rdvSelector->getAgenda();

            $dateFin = clone $rdvSelector->getDateDebut();
            $dateFin->add(new \DateInterval($rdvSelector->getPeriod()));

            $slots = $em->getRepository('ExploticAgendaBundle:CreneauRdv')->findByPeriod($rdvSelector->getDateDebut(),$dateFin);
            
            if(empty($slots)){
                throw new \Symfony\Component\Translation\Exception\NotFoundResourceException('Aucun créneau n\'existe sur la période demandée');
            }
            $slots = new \Doctrine\Common\Collections\ArrayCollection($slots);
            //On utilise la classe bookinggen pour concevoir le formulaire de création des créneaux prefs
            $generateur = $this->get('explotic_agenda.booking.generator');   
//            $generateur->setBookingEngine($this->get('explotic_agenda.booking.engine'));
            $generateur->init($slots,$rdvSelector->getBookingType());

            $formType = new \Explotic\AgendaBundle\Form\RdvAgendaType();
            //Construction de l'agenda servant de support d'affichage des créneaux modèles dans le formulaire
            $agendasView= $this->buildAgendas($slots,$agenda,$rdvSelector->getDateDebut());
            $formType->init($agendasView,$rdvSelector->getDateDebut(),$rdvSelector->getPeriod());
            $form = $this->createForm($formType, $generateur);     

            return $this->render('ExploticAgendaBundle:Rdv:new/selected.html.twig', array(
                'generateur' => $generateur,
                'agendas' => $agendasView,
                'form'   => $form->createView(),
            ));
        }
        return $this->redirect($this->generateUrl('profil'));
    }
    
    public function buildAgendas($slots,$agenda,$dateDebut){
        // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
        // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
               
        $agendasView = new \Doctrine\Common\Collections\ArrayCollection();           
        
        if($slots){
            $agendasView->add( new \Explotic\AgendaBundle\Model\Agenda());
            $agendasView->last()->init($dateDebut->format('W'),$dateDebut->format('o'),null,1);
            $agendasView->last()->generateAgenda($slots,$agenda->getRdvs(), 420 ,1140);            
        }
        else{ return new \Symfony\Component\HttpFoundation\Response('<p> Planning non défini </p>');}
         
        return $agendasView;
    }
    
    public function createSelectedRdvAction(Request $Request){
        
    }
}
