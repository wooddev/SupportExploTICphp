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
    
    public function newListAction($type,$id){
        

        
        $dateDebut = new \DateTime();
        $dateFin = new \DateTime();
        $interval= new \DateInterval('P1M');
        $dateFin->add($interval);
        
        //$user = $this->get('security.context')->getToken()->getUser();
        
        //###################################################
        //###################################################
        //###################################################
        //######FAILLE DE SECURITE ICI ###################### 
        //###################################################
        //==>>>>>>>>> VERIFIER DROITS ACCES Du USER A TIERS<<<<
        //>>>>>>>>>>>>EN COURS DE RESA <<<<<<<<<<<<<<<<<<<<<<<<
        //###################################################
        //###################################################
        
        $rdvSelector = $this->container->get('explotic_agenda.rdv_selector')
                                ->generateSelector($dateDebut,4,array('type'=>$type,'id'=>$id));
        
        
        return $this->render('ExploticAgendaBundle:Rdv:newList.html.twig', array(
            'rdvSelector'=>$rdvSelector,
            'type'=>$type,
            'id'=>$id,
            'agenda'=> $rdvSelector->getAgenda(),
        ));        
    }
    
    public function createListAction($id, $type,  Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $creneauxRdvsIds = $request->request->get('creneauRdv');
        $statut = $request->request->get('statutRdv');
        
        foreach($creneauxRdvsIds as $idCreneau){
            $rdv = new Rdv();
            if($type == 'Session'){
                $typeRdv = $em->getRepository("ExploticAgendaBundle:TypeRdv")->find(2);               
                $entity = $em->getRepository("ExploticPlanningBundle:".$type)->find($id); 
            }else{
                $typeRdv = $em->getRepository("ExploticAgendaBundle:TypeRdv")->find(1);
                $entity = $em->getRepository("ExploticTiersBundle:".$type)->find($id);  
            }

            $rdv->setCalendrier($entity->getCalendrier());
            $rdv->setType($typeRdv);
            $rdv->setCreneauRdv($em->getRepository("ExploticAgendaBundle:CreneauRdv")->find($idCreneau));
            $rdv->setStatutRdv($statut);
            $em->persist($rdv);          
        }
        $em->flush(); 
        
        return $this->redirect($this->generateUrl('rdv'));
    }
}
