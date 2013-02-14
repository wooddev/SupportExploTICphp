<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Recruteur;
use Explotic\TiersBundle\Form\RecruteurType;

/**
 * Recruteur controller.
 *
 */
class RecruteurController extends Controller
{
    /**
     * Lists all Recruteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Recruteur')->findAll();

        return $this->render('ExploticTiersBundle:Recruteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Recruteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Recruteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recruteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Recruteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Recruteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Recruteur();
        $form   = $this->createForm(new RecruteurType(), $entity);

        return $this->render('ExploticTiersBundle:Recruteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Recruteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Recruteur();
        $form = $this->createForm(new RecruteurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recruteur_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Recruteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Recruteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Recruteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recruteur entity.');
        }

        $editForm = $this->createForm(new RecruteurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Recruteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Recruteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Recruteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recruteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RecruteurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recruteur_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Recruteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Recruteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Recruteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recruteur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recruteur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
