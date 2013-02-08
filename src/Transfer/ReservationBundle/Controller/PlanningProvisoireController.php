<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\PlanningProvisoire;
use Transfer\ReservationBundle\Form\PlanningProvisoireType;

/**
 * PlanningProvisoire controller.
 *
 */
class PlanningProvisoireController extends Controller
{
    /**
     * Lists all PlanningProvisoire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:PlanningProvisoire')->findAll();

        return $this->render('TransferReservationBundle:PlanningProvisoire:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a PlanningProvisoire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningProvisoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningProvisoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:PlanningProvisoire:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PlanningProvisoire entity.
     *
     */
    public function newAction()
    {
        $entity = new PlanningProvisoire();
        $form   = $this->createForm(new PlanningProvisoireType(), $entity);

        return $this->render('TransferReservationBundle:PlanningProvisoire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PlanningProvisoire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PlanningProvisoire();
        $form = $this->createForm(new PlanningProvisoireType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planningprovisoire_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:PlanningProvisoire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PlanningProvisoire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningProvisoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningProvisoire entity.');
        }

        $editForm = $this->createForm(new PlanningProvisoireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:PlanningProvisoire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PlanningProvisoire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningProvisoire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningProvisoire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PlanningProvisoireType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planningprovisoire_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:PlanningProvisoire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PlanningProvisoire entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:PlanningProvisoire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanningProvisoire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('planningprovisoire'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
