<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\EtatReservation;
use Transfer\ReservationBundle\Form\EtatReservationType;

/**
 * EtatReservation controller.
 *
 */
class EtatReservationController extends Controller
{
    /**
     * Lists all EtatReservation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:EtatReservation')->findAll();

        return $this->render('TransferReservationBundle:EtatReservation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a EtatReservation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:EtatReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtatReservation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:EtatReservation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new EtatReservation entity.
     *
     */
    public function newAction()
    {
        $entity = new EtatReservation();
        $form   = $this->createForm(new EtatReservationType(), $entity);

        return $this->render('TransferReservationBundle:EtatReservation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new EtatReservation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new EtatReservation();
        $form = $this->createForm(new EtatReservationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etatreservation_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:EtatReservation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EtatReservation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:EtatReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtatReservation entity.');
        }

        $editForm = $this->createForm(new EtatReservationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:EtatReservation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing EtatReservation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:EtatReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EtatReservation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EtatReservationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etatreservation_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:EtatReservation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a EtatReservation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:EtatReservation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EtatReservation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('etatreservation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
