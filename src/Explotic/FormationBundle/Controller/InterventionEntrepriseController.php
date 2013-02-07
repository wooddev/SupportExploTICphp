<?php

namespace Explotic\FormationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\FormationBundle\Entity\InterventionEntreprise;
use Explotic\FormationBundle\Form\InterventionEntrepriseType;

/**
 * InterventionEntreprise controller.
 *
 */
class InterventionEntrepriseController extends Controller
{
    /**
     * Lists all InterventionEntreprise entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticFormationBundle:InterventionEntreprise')->findAll();

        return $this->render('ExploticFormationBundle:InterventionEntreprise:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a InterventionEntreprise entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionEntreprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionEntreprise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:InterventionEntreprise:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new InterventionEntreprise entity.
     *
     */
    public function newAction()
    {
        $entity = new InterventionEntreprise();
        $form   = $this->createForm(new InterventionEntrepriseType(), $entity);

        return $this->render('ExploticFormationBundle:InterventionEntreprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new InterventionEntreprise entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new InterventionEntreprise();
        $form = $this->createForm(new InterventionEntrepriseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('interventionentreprise_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticFormationBundle:InterventionEntreprise:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InterventionEntreprise entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionEntreprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionEntreprise entity.');
        }

        $editForm = $this->createForm(new InterventionEntrepriseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:InterventionEntreprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing InterventionEntreprise entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:InterventionEntreprise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InterventionEntreprise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InterventionEntrepriseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('interventionentreprise_edit', array('id' => $id)));
        }

        return $this->render('ExploticFormationBundle:InterventionEntreprise:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InterventionEntreprise entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticFormationBundle:InterventionEntreprise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InterventionEntreprise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('interventionentreprise'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
