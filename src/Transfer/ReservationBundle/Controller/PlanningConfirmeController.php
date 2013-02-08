<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\PlanningConfirme;
use Transfer\ReservationBundle\Form\PlanningConfirmeType;

/**
 * PlanningConfirme controller.
 *
 */
class PlanningConfirmeController extends Controller
{
    /**
     * Lists all PlanningConfirme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:PlanningConfirme')->findAll();

        return $this->render('TransferReservationBundle:PlanningConfirme:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a PlanningConfirme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningConfirme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningConfirme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:PlanningConfirme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PlanningConfirme entity.
     *
     */
    public function newAction()
    {
        $entity = new PlanningConfirme();
        $form   = $this->createForm(new PlanningConfirmeType(), $entity);

        return $this->render('TransferReservationBundle:PlanningConfirme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PlanningConfirme entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PlanningConfirme();
        $form = $this->createForm(new PlanningConfirmeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planningconfirme_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:PlanningConfirme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PlanningConfirme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningConfirme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningConfirme entity.');
        }

        $editForm = $this->createForm(new PlanningConfirmeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:PlanningConfirme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PlanningConfirme entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:PlanningConfirme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanningConfirme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PlanningConfirmeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planningconfirme_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:PlanningConfirme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PlanningConfirme entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:PlanningConfirme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanningConfirme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('planningconfirme'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
