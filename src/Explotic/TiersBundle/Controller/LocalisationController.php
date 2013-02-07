<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Localisation;
use Explotic\TiersBundle\Form\LocalisationType;

/**
 * Localisation controller.
 *
 */
class LocalisationController extends Controller
{
    /**
     * Lists all Localisation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Localisation')->findAll();

        return $this->render('ExploticTiersBundle:Localisation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Localisation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Localisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localisation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Localisation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Localisation entity.
     *
     */
    public function newAction()
    {
        $entity = new Localisation();
        $form   = $this->createForm(new LocalisationType(), $entity);

        return $this->render('ExploticTiersBundle:Localisation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Localisation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Localisation();
        $form = $this->createForm(new LocalisationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('localisation_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Localisation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Localisation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Localisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localisation entity.');
        }

        $editForm = $this->createForm(new LocalisationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Localisation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Localisation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Localisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localisation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LocalisationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('localisation_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Localisation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Localisation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Localisation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Localisation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('localisation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
