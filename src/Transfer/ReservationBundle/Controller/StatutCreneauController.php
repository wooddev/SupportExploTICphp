<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\StatutCreneau;
use Transfer\ReservationBundle\Form\StatutCreneauType;

/**
 * StatutCreneau controller.
 *
 */
class StatutCreneauController extends Controller
{
    /**
     * Lists all StatutCreneau entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:StatutCreneau')->findAll();

        return $this->render('TransferReservationBundle:StatutCreneau:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a StatutCreneau entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:StatutCreneau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutCreneau entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:StatutCreneau:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new StatutCreneau entity.
     *
     */
    public function newAction()
    {
        $entity = new StatutCreneau();
        $form   = $this->createForm(new StatutCreneauType(), $entity);

        return $this->render('TransferReservationBundle:StatutCreneau:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new StatutCreneau entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new StatutCreneau();
        $form = $this->createForm(new StatutCreneauType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statutcreneau_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:StatutCreneau:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StatutCreneau entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:StatutCreneau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutCreneau entity.');
        }

        $editForm = $this->createForm(new StatutCreneauType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:StatutCreneau:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing StatutCreneau entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:StatutCreneau')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutCreneau entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StatutCreneauType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statutcreneau_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:StatutCreneau:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a StatutCreneau entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:StatutCreneau')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StatutCreneau entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('statutcreneau'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
