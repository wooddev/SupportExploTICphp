<?php

namespace Transfer\ProfilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ProfilBundle\Entity\AgentDab;
use Transfer\ProfilBundle\Form\AgentDabType;

/**
 * AgentDab controller.
 *
 */
class AgentDabController extends Controller
{

    /**
     * Lists all AgentDab entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferProfilBundle:AgentDab')->findAll();

        return $this->render('TransferProfilBundle:AgentDab:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AgentDab entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new AgentDab();
        $form = $this->createForm(new AgentDabType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agentdab_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferProfilBundle:AgentDab:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new AgentDab entity.
     *
     */
    public function newAction()
    {
        $entity = new AgentDab();
        $form   = $this->createForm(new AgentDabType(), $entity);

        return $this->render('TransferProfilBundle:AgentDab:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AgentDab entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentDab')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentDab entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentDab:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AgentDab entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentDab')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentDab entity.');
        }

        $editForm = $this->createForm(new AgentDabType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentDab:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AgentDab entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentDab')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentDab entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AgentDabType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agentdab_edit', array('id' => $id)));
        }

        return $this->render('TransferProfilBundle:AgentDab:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AgentDab entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferProfilBundle:AgentDab')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AgentDab entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agentdab'));
    }

    /**
     * Creates a form to delete a AgentDab entity by id.
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
