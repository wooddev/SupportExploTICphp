<?php

namespace Transfer\ProfilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ProfilBundle\Entity\AgentTrsp;
use Transfer\ProfilBundle\Form\AgentTrspType;

/**
 * AgentTrsp controller.
 *
 */
class AgentTrspController extends Controller
{
    /**
     * Lists all AgentTrsp entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferProfilBundle:AgentTrsp')->findAll();

        return $this->render('TransferProfilBundle:AgentTrsp:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a AgentTrsp entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentTrsp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentTrsp entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentTrsp:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new AgentTrsp entity.
     *
     */
    public function newAction()
    {
        $entity = new AgentTrsp();
        $form   = $this->createForm(new AgentTrspType(), $entity);

        return $this->render('TransferProfilBundle:AgentTrsp:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new AgentTrsp entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new AgentTrsp();
        $form = $this->createForm(new AgentTrspType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agenttrsp_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferProfilBundle:AgentTrsp:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AgentTrsp entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentTrsp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentTrsp entity.');
        }

        $editForm = $this->createForm(new AgentTrspType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentTrsp:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AgentTrsp entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentTrsp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentTrsp entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AgentTrspType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agenttrsp_edit', array('id' => $id)));
        }

        return $this->render('TransferProfilBundle:AgentTrsp:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AgentTrsp entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferProfilBundle:AgentTrsp')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AgentTrsp entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agenttrsp'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
