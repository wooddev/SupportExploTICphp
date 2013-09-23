<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Stagiaire;
use Explotic\TiersBundle\Form\StagiaireType;

/**
 * Stagiaire controller.
 *
 */
class StagiaireController extends Controller
{
    /**
     * Lists all Stagiaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            $entities = $em->getRepository('ExploticTiersBundle:Stagiaire')->findAll();
        }else{
            $entities = $em->getRepository('ExploticTiersBundle:Stagiaire')->findAuthorized($this->get('security.context')->getToken()->getUser());
        }
        
        return $this->render('ExploticTiersBundle:Stagiaire:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Stagiaire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);
        $this->get('explotic_admin.user.access_control')->controlAccessToUser($entity);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }       
            
        // Génération de l'agenda pour la semaine en cours
        $agenda = new \Explotic\MainBundle\Model\Agenda();        
        $agenda->init((int)date('W'), (int) date('Y'));        
            //Recherche des jours figurant dans cette partie du calendrier   
        if (!(null===$entity->getCalendrier())){
            $jours = $em->getRepository('ExploticPlanningBundle:Jour')
                        ->findByCalendrierAndDate(
                                $entity->getCalendrier()->getId(),
                                $agenda->getDateDebut(),
                                $agenda->getDateFin()
                      );           
        } else{
            $jours = null;
        }      

        return $this->render('ExploticTiersBundle:Stagiaire:show.html.twig', array(
            'entity'      => $entity,
            'agenda' => $agenda->generate($jours),
            'entreprise' => $entity->getEntreprise(),
            ));
    }

    /**
     * Displays a form to create a new Stagiaire entity.
     *
     */
    public function newAction()
    {
        $entity = new Stagiaire();
        $form   = $this->createForm(new StagiaireType(), $entity);

        return $this->render('ExploticTiersBundle:Stagiaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Stagiaire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Stagiaire();
        $form = $this->createForm(new StagiaireType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Stagiaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stagiaire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);
        $this->get('explotic_admin.user.acess_control')->controlAccessToUser($entity);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $editForm = $this->createForm(new StagiaireType(), $entity);
        

        return $this->render('ExploticTiersBundle:Stagiaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            
        ));
    }

    /**
     * Edits an existing Stagiaire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);
        $this->get('explotic_admin.user.acess_control')->controlAccessToUser($entity);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        
        $editForm = $this->createForm(new StagiaireType(), $entity);
        $editForm->bind($request);        

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Stagiaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            
        ));
    }   
    
    public function programmationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);      
        $this->get('explotic_admin.user.acess_control')->controlAccessToUser($stagiaire);
        if (!$stagiaire) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }
        
        $programmes = $em->getRepository('ExploticFormationBundle:Programme')->findByStagiaire($id);
        
        if (!$programmes) {
            throw $this->createNotFoundException('Unable to find programmes entities.');
        }
        
        return $this->render('ExploticFormationBundle:Programme:indexStagiaire.html.twig', array(
            'entities'      => $programmes,
            'stagiaire' => $stagiaire,
        ));
    }
                        
    public function voirPostesAction(Request $request, $id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);   
        
        $this->get('explotic_admin.user.acess_control')->controlAccessToUser($stagiaire);
        
        if (!$stagiaire) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }
        
        $postes = $em->getRepository('ExploticTiersBundle:Poste')->findByStagiaire($id);
        
        if (!$postes) {
            throw $this->createNotFoundException('Unable to find Poste entities.');
        }
        
        return $this->render('ExploticTiersBundle:Poste:indexStagiaire/content.html.twig', array(
            'entities'      => $postes,
            'stagiaire' => $stagiaire,
        ));                    
    }
    
    public function editAgendaForm(Stagiaire $stagiaire){
        $agenda = $stagiaire->getCalendrier();
        
        $rdvSelector = new \Explotic\AgendaBundle\Model\RdvSelector();
        $rdvSelector->setDateDebut(new \DateTime('last monday'));
        $rdvSelector->setPeriod('1');
        $rdvSelector->setBookingType('tiers');
        $rdvSelector->setAgenda($agenda);
        $formType = new \Explotic\AgendaBundle\Form\RdvSelectorType();
        return $this->createForm($formType, $rdvSelector); 
    }
    
    public function showAgendaForm(Stagiaire $stagiaire){
        $entity = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $now= new \DateTime();
        $entity->setYear((int)$now->format('o'));
        $entity->setWeek((int)$now->format('W'));
        $entity->setDuree= 4;               
        return $this->createForm(new AgendaExtractType(), $entity);
    }
    

}
