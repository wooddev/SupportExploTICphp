<?php

namespace Explotic\PlanningBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\PlanningBundle\Entity\Jour;
use Explotic\PlanningBundle\Form\JourType;

/**
 * Jour controller.
 *
 */
class JourController extends Controller
{
    /**
     * Lists all Jour entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticPlanningBundle:Jour')->findAll();

        return $this->render('ExploticPlanningBundle:Jour:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Jour entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Jour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jour entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:Jour:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Jour entity.
     *
     */
    public function newAction()
    {
        $entity = new Jour();
        $form   = $this->createForm(new JourType(), $entity);

        return $this->render('ExploticPlanningBundle:Jour:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Jour entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Jour();
        $form = $this->createForm(new JourType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jour_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticPlanningBundle:Jour:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Jour entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Jour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jour entity.');
        }

        $editForm = $this->createForm(new JourType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:Jour:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Jour entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Jour')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jour entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JourType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jour_edit', array('id' => $id)));
        }

        return $this->render('ExploticPlanningBundle:Jour:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Jour entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticPlanningBundle:Jour')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Jour entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jour'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
