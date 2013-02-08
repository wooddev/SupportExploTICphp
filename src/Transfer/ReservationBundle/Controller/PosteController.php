<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\Poste;
use Transfer\ReservationBundle\Form\PosteType;

/**
 * Poste controller.
 *
 */
class PosteController extends Controller
{
    /**
     * Lists all Poste entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:Poste')->findAll();

        return $this->render('TransferReservationBundle:Poste:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Poste entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Poste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Poste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Poste:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Poste entity.
     *
     */
    public function newAction()
    {
        $entity = new Poste();
        $form   = $this->createForm(new PosteType(), $entity);

        return $this->render('TransferReservationBundle:Poste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Poste entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Poste();
        $form = $this->createForm(new PosteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poste_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:Poste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Poste entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Poste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Poste entity.');
        }

        $editForm = $this->createForm(new PosteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Poste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Poste entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Poste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Poste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PosteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poste_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:Poste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Poste entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:Poste')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Poste entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poste'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
