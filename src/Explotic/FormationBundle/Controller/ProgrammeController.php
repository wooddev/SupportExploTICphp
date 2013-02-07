<?php

namespace Explotic\FormationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\FormationBundle\Entity\Programme;
use Explotic\FormationBundle\Form\ProgrammeType;

/**
 * Programme controller.
 *
 */
class ProgrammeController extends Controller
{
    /**
     * Lists all Programme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticFormationBundle:Programme')->findAll();

        return $this->render('ExploticFormationBundle:Programme:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Lists all Programme entities // Pour un stagiaire particulier
     *
     */
    public function indexStagiaireAction($idStagiaire)
    {
        $em = $this->getDoctrine()->getManager();
      
        $programmes = $em->getRepository('ExploticFormationBundle:Programme')->findByStagiaire($idStagiaire);
        
        if (!$programmes) {
            throw $this->createNotFoundException('Unable to find programmes entities.');
        }
        
        return $this->render('ExploticFormationBundle:Programme:indexStagiare.html.twig', array(
            'entities'      => $programmes,
            'idStagiaire' => $idStagiaire,
        ));
    }

    /**
     * Finds and displays a Programme entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:Programme:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Programme entity.
     * Intègre le paramètre idStg
     *      --> si All : procédure classique de création d'un programme
     *      --> si id d'un stagiaire : procédure de création d'un programme attribué à un stagiare id
     *
     */
    public function newAction($idStg)
    {
        $entity = new Programme();

        
        if($idStg<>'all'){
            // on attribue l'id du stagiaire
            $em = $this->getDoctrine()->getManager();
            $stagiaire= $em->getRepository('ExploticTiersBundle:Stagiaire')->find($idStg);
            if(!$stagiaire){
                throw $this->createNotFoundException('Unable to find Stagiaire entity.');
                }
            $entity->setStagiaire($stagiaire);
            //on génére un formulaire où le choix du stagiaire est disabled
            $form   = $this->createForm(new ProgrammeType(), $entity);            
        }
        else {
            $form   = $this->createForm(new ProgrammeType(), $entity, array(
                'disabled'=> false,
                ));                        
        }
        
        return $this->render('ExploticFormationBundle:Programme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Programme entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Programme();
        $form = $this->createForm(new ProgrammeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('programme_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticFormationBundle:Programme:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Programme entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }

        $editForm = $this->createForm(new ProgrammeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticFormationBundle:Programme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Programme entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticFormationBundle:Programme')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programme entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProgrammeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('programme_edit', array('id' => $id)));
        }

        return $this->render('ExploticFormationBundle:Programme:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Programme entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticFormationBundle:Programme')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Programme entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('programme'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
