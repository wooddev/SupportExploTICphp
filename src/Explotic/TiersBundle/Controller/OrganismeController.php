<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Organisme;
use Explotic\TiersBundle\Form\OrganismeType;

/**
 * Organisme controller.
 *
 */
class OrganismeController extends Controller
{
    /**
     * Lists all Organisme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Organisme')->findAll();

        return $this->render('ExploticTiersBundle:Organisme:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Organisme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Organisme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Organisme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Organisme entity.
     *
     */
    public function newAction()
    {
        $entity = new Organisme();
        $form   = $this->createForm(new OrganismeType(), $entity);

        return $this->render('ExploticTiersBundle:Organisme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Organisme entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Organisme();
        $form = $this->createForm(new OrganismeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organisme_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Organisme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organisme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Organisme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisme entity.');
        }

        $editForm = $this->createForm(new OrganismeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Organisme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Organisme entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Organisme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OrganismeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organisme_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Organisme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Organisme entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Organisme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organisme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organisme'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
