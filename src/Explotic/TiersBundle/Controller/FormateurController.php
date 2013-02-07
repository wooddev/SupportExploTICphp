<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Formateur;
use Explotic\TiersBundle\Form\FormateurType;

/**
 * Formateur controller.
 *
 */
class FormateurController extends Controller
{
    /**
     * Lists all Formateur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Formateur')->findAll();

        return $this->render('ExploticTiersBundle:Formateur:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Formateur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Formateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Formateur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Formateur entity.
     *
     */
    public function newAction()
    {
        $entity = new Formateur();
        $form   = $this->createForm(new FormateurType(), $entity);

        return $this->render('ExploticTiersBundle:Formateur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Formateur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Formateur();
        $form = $this->createForm(new FormateurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formateur_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Formateur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Formateur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Formateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateur entity.');
        }

        $editForm = $this->createForm(new FormateurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Formateur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Formateur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Formateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FormateurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formateur_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Formateur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Formateur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Formateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formateur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
