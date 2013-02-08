<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\TypePoste;
use Transfer\ReservationBundle\Form\TypePosteType;

/**
 * TypePoste controller.
 *
 */
class TypePosteController extends Controller
{
    /**
     * Lists all TypePoste entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:TypePoste')->findAll();

        return $this->render('TransferReservationBundle:TypePoste:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a TypePoste entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypePoste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePoste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:TypePoste:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new TypePoste entity.
     *
     */
    public function newAction()
    {
        $entity = new TypePoste();
        $form   = $this->createForm(new TypePosteType(), $entity);

        return $this->render('TransferReservationBundle:TypePoste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new TypePoste entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypePoste();
        $form = $this->createForm(new TypePosteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeposte_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:TypePoste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypePoste entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypePoste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePoste entity.');
        }

        $editForm = $this->createForm(new TypePosteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:TypePoste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypePoste entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypePoste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePoste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypePosteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typeposte_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:TypePoste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypePoste entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:TypePoste')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypePoste entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typeposte'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
