<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\TypeCamion;
use Transfer\ReservationBundle\Form\TypeCamionType;

/**
 * TypeCamion controller.
 *
 */
class TypeCamionController extends Controller
{

    /**
     * Lists all TypeCamion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:TypeCamion')->findAll();

        return $this->render('TransferReservationBundle:TypeCamion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TypeCamion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeCamion();
        $form = $this->createForm(new TypeCamionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typecamion_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:TypeCamion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TypeCamion entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeCamion();
        $form   = $this->createForm(new TypeCamionType(), $entity);

        return $this->render('TransferReservationBundle:TypeCamion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeCamion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypeCamion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeCamion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:TypeCamion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TypeCamion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypeCamion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeCamion entity.');
        }

        $editForm = $this->createForm(new TypeCamionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:TypeCamion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeCamion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:TypeCamion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeCamion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypeCamionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typecamion_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:TypeCamion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TypeCamion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:TypeCamion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeCamion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typecamion'));
    }

    /**
     * Creates a form to delete a TypeCamion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
