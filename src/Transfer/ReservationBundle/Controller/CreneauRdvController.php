<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ReservationBundle\Form\CreneauRdvType;
use Transfer\ReservationBundle\Form\CreneauRdvRechercheType;

/**
 * CreneauRdv controller.
 *
 */
class CreneauRdvController extends Controller
{
    /**
     * Lists all CreneauRdv entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:CreneauRdv')->findAll();

        return $this->render('TransferReservationBundle:CreneauRdv:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CreneauRdv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauRdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new CreneauRdv entity.
     *
     */
    public function newAction()
    {
        $entity = new CreneauRdv();
        $form   = $this->createForm(new CreneauRdvType(), $entity);

        return $this->render('TransferReservationBundle:CreneauRdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CreneauRdv entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CreneauRdv();
        $form = $this->createForm(new CreneauRdvType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaurdv_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:CreneauRdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CreneauRdv entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $editForm = $this->createForm(new CreneauRdvType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauRdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CreneauRdv entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CreneauRdvType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaurdv_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:CreneauRdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CreneauRdv entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('creneaurdv'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
    
    public function rechercheAction(){       
               
        $entity = new CreneauRdv();
        $entity->setAnnee(date('o')); // Année au format ISO !!IMPORTANT POUR RESPECTER LA CODIFICATION ISO DES SEMAINES 
        $entity->setSemaine(date('W')+1);
        $form   = $this->createForm(new CreneauRdvRechercheType(), $entity);
        $dateDebut = new \DateTime(date('o').'W'.(date('W')+1));
        $dateFin = new \DateTime(date('o').'W'.(date('W')+1)."6");
        
        
        return $this->render('TransferReservationBundle:CreneauRdv:recherche/formulaire.html.twig', array(
            'dateDebut'=> $dateDebut,
            'dateFin'=> $dateFin,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));      

//        $entity = new CreneauRdv();
//        $entity->setAnnee(date('o')); // Année au format ISO !!IMPORTANT POUR RESPECTER LA CODIFICATION ISO DES SEMAINES 
//        $entity->setSemaine(date('W'));
//        $form   = $this->createForm(new CreneauRdvType(), $entity);
//
//        return $this->render('TransferReservationBundle:CreneauRdv:recherche/formulaire.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
    }  
        
}
