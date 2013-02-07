<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\SiteIntervention;
use Explotic\TiersBundle\Form\SiteInterventionType;

/**
 * SiteIntervention controller.
 *
 */
class SiteInterventionController extends Controller
{
    /**
     * Lists all SiteIntervention entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:SiteIntervention')->findAll();

        return $this->render('ExploticTiersBundle:SiteIntervention:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a SiteIntervention entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:SiteIntervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SiteIntervention entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:SiteIntervention:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new SiteIntervention entity.
     *
     */
    public function newAction()
    {
        $entity = new SiteIntervention();
        $form   = $this->createForm(new SiteInterventionType(), $entity);

        return $this->render('ExploticTiersBundle:SiteIntervention:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new SiteIntervention entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new SiteIntervention();
        $form = $this->createForm(new SiteInterventionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('siteintervention_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:SiteIntervention:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SiteIntervention entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:SiteIntervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SiteIntervention entity.');
        }

        $editForm = $this->createForm(new SiteInterventionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:SiteIntervention:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing SiteIntervention entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:SiteIntervention')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SiteIntervention entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SiteInterventionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('siteintervention_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:SiteIntervention:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SiteIntervention entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:SiteIntervention')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SiteIntervention entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('siteintervention'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
