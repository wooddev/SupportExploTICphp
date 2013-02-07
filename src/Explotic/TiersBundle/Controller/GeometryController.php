<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Geometry;
use Explotic\TiersBundle\Form\GeometryType;

/**
 * Geometry controller.
 *
 */
class GeometryController extends Controller
{
    /**
     * Lists all Geometry entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Geometry')->findAll();

        return $this->render('ExploticTiersBundle:Geometry:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Geometry entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Geometry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Geometry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Geometry:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Geometry entity.
     *
     */
    public function newAction()
    {
        $entity = new Geometry();
        $form   = $this->createForm(new GeometryType(), $entity);

        return $this->render('ExploticTiersBundle:Geometry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Geometry entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Geometry();
        $form = $this->createForm(new GeometryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('geometry_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Geometry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Geometry entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Geometry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Geometry entity.');
        }

        $editForm = $this->createForm(new GeometryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Geometry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Geometry entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Geometry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Geometry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GeometryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('geometry_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Geometry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Geometry entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Geometry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Geometry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('geometry'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
