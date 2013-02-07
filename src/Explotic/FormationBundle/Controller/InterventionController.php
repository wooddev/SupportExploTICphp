<?php

namespace Explotic\FormationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\FormationBundle\Entity\Intervention;
use Explotic\FormationBundle\Form\InterventionType;

/**
 * Intervention controller.
 *
 */
class InterventionController extends Controller
{
    /**
     * Lists all Intervention entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticFormationBundle:Intervention')->findAll();

        return $this->render('ExploticFormationBundle:Intervention:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Intervention entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Intervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervention entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:Intervention:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Intervention entity.
     *
     */
    public function newAction()
    {
        $entity = new Intervention();
        $form   = $this->createForm(new InterventionType(), $entity);

        return $this->render('ExploticFormationBundle:Intervention:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Intervention entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Intervention();
        $form = $this->createForm(new InterventionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('intervention_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticFormationBundle:Intervention:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Intervention entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Intervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervention entity.');
        }

        $editForm = $this->createForm(new InterventionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:Intervention:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Intervention entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Intervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervention entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InterventionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('intervention_edit', array('id' => $id)));
        }

        return $this->render('ExploticFormationBundle:Intervention:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Intervention entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticFormationBundle:Intervention')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Intervention entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('intervention'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
