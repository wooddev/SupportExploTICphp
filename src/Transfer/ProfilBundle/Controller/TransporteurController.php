<?php

namespace Transfer\ProfilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ProfilBundle\Entity\Transporteur;
use Transfer\ProfilBundle\Form\TransporteurType;

/**
 * Transporteur controller.
 *
 */
class TransporteurController extends Controller
{
    /**
     * Lists all Transporteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferProfilBundle:Transporteur')->findAll();

        return $this->render('TransferProfilBundle:Transporteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Transporteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:Transporteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transporteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:Transporteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Transporteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Transporteur();
        $form   = $this->createForm(new TransporteurType(), $entity);

        return $this->render('TransferProfilBundle:Transporteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Transporteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Transporteur();
        $form = $this->createForm(new TransporteurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('transporteur_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferProfilBundle:Transporteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Transporteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:Transporteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transporteur entity.');
        }

        $editForm = $this->createForm(new TransporteurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:Transporteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Transporteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:Transporteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transporteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TransporteurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('transporteur_edit', array('id' => $id)));
        }

        return $this->render('TransferProfilBundle:Transporteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Transporteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferProfilBundle:Transporteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Transporteur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('transporteur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
