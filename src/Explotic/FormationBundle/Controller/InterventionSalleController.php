<?php

namespace Explotic\FormationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\FormationBundle\Entity\InterventionSalle;
use Explotic\FormationBundle\Form\InterventionSalleType;

/**
 * InterventionSalle controller.
 *
 */
class InterventionSalleController extends Controller
{
    /**
     * Lists all InterventionSalle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticFormationBundle:InterventionSalle')->findAll();

        return $this->render('ExploticFormationBundle:InterventionSalle:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a InterventionSalle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionSalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionSalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:InterventionSalle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new InterventionSalle entity.
     *
     */
    public function newAction()
    {
        $entity = new InterventionSalle();
        $form   = $this->createForm(new InterventionSalleType(), $entity);

        return $this->render('ExploticFormationBundle:InterventionSalle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new InterventionSalle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new InterventionSalle();
        $form = $this->createForm(new InterventionSalleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('interventionsalle_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticFormationBundle:InterventionSalle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InterventionSalle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionSalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionSalle entity.');
        }

        $editForm = $this->createForm(new InterventionSalleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:InterventionSalle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing InterventionSalle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionSalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionSalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InterventionSalleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('interventionsalle_edit', array('id' => $id)));
        }

        return $this->render('ExploticFormationBundle:InterventionSalle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InterventionSalle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticFormationBundle:InterventionSalle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InterventionSalle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('interventionsalle'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
