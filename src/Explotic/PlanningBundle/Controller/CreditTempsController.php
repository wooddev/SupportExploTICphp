<?php

namespace Explotic\PlanningBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\PlanningBundle\Entity\CreditTemps;
use Explotic\PlanningBundle\Form\CreditTempsType;

/**
 * CreditTemps controller.
 *
 */
class CreditTempsController extends Controller
{
    /**
     * Lists all CreditTemps entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticPlanningBundle:CreditTemps')->findAll();

        return $this->render('ExploticPlanningBundle:CreditTemps:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CreditTemps entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:CreditTemps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreditTemps entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:CreditTemps:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new CreditTemps entity.
     *
     */
    public function newAction()
    {
        $entity = new CreditTemps();
        $form   = $this->createForm(new CreditTempsType(), $entity);

        return $this->render('ExploticPlanningBundle:CreditTemps:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CreditTemps entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CreditTemps();
        $form = $this->createForm(new CreditTempsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('credittemps_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticPlanningBundle:CreditTemps:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CreditTemps entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:CreditTemps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreditTemps entity.');
        }

        $editForm = $this->createForm(new CreditTempsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:CreditTemps:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CreditTemps entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:CreditTemps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreditTemps entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CreditTempsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('credittemps_edit', array('id' => $id)));
        }

        return $this->render('ExploticPlanningBundle:CreditTemps:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CreditTemps entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticPlanningBundle:CreditTemps')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CreditTemps entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('credittemps'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
