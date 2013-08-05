<?php

namespace Transfer\ProfilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ProfilBundle\Entity\AgentReception;
use Transfer\ProfilBundle\Form\AgentReceptionType;

/**
 * AgentReception controller.
 *
 */
class AgentReceptionController extends Controller
{

    /**
     * Lists all AgentReception entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferProfilBundle:AgentReception')->findAll();

        return $this->render('TransferProfilBundle:AgentReception:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AgentReception entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new AgentReception();
        $form = $this->createForm(new AgentReceptionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agentreception_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferProfilBundle:AgentReception:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new AgentReception entity.
     *
     */
    public function newAction()
    {
        $entity = new AgentReception();
        $form   = $this->createForm(new AgentReceptionType(), $entity);

        return $this->render('TransferProfilBundle:AgentReception:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AgentReception entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentReception entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentReception:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AgentReception entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentReception entity.');
        }

        $editForm = $this->createForm(new AgentReceptionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferProfilBundle:AgentReception:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing AgentReception entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferProfilBundle:AgentReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgentReception entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AgentReceptionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agentreception_edit', array('id' => $id)));
        }

        return $this->render('TransferProfilBundle:AgentReception:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AgentReception entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferProfilBundle:AgentReception')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AgentReception entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agentreception'));
    }

    /**
     * Creates a form to delete a AgentReception entity by id.
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
