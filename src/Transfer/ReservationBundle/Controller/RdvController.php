<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\Rdv;
use Transfer\ReservationBundle\Form\RdvType;

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
}