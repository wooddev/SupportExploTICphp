<?php

namespace Explotic\TiersBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\TiersBundle\Entity\Stagiaire;
use Explotic\TiersBundle\Form\StagiaireType;

/**
 * Stagiaire controller.
 *
 */
class StagiaireController extends Controller
{
    /**
     * Lists all Stagiaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticTiersBundle:Stagiaire')->findAll();

        return $this->render('ExploticTiersBundle:Stagiaire:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Stagiaire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Stagiaire:show.html.twig', array(
            'entity'      => $entity,
            'entreprise' => $entity->getEntreprise(),
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to create a new Stagiaire entity.
     *
     */
    public function newAction()
    {
        $entity = new Stagiaire();
        $form   = $this->createForm(new StagiaireType(), $entity);

        return $this->render('ExploticTiersBundle:Stagiaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Stagiaire entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Stagiaire();
        $form = $this->createForm(new StagiaireType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticTiersBundle:Stagiaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stagiaire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $editForm = $this->createForm(new StagiaireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticTiersBundle:Stagiaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Stagiaire entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StagiaireType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stagiaire_edit', array('id' => $id)));
        }

        return $this->render('ExploticTiersBundle:Stagiaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Stagiaire entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stagiaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stagiaire'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function programmationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);      
        
        if (!$stagiaire) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }
        
        $programmes = $em->getRepository('ExploticFormationBundle:Programme')->findByStagiaire($id);
        
        if (!$programmes) {
            throw $this->createNotFoundException('Unable to find programmes entities.');
        }
        
        return $this->render('ExploticFormationBundle:Programme:indexStagiaire.html.twig', array(
            'entities'      => $programmes,
            'stagiaire' => $stagiaire,
        ));
    }
                        
    public function voirPostesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('ExploticTiersBundle:Stagiaire')->find($id);      
        
        if (!$stagiaire) {
            throw $this->createNotFoundException('Unable to find Stagiaire entity.');
        }
        
        $postes = $em->getRepository('ExploticTiersBundle:Poste')->findByStagiaire($id);
        
        if (!$postes) {
            throw $this->createNotFoundException('Unable to find Poste entities.');
        }
        
        return $this->render('ExploticTiersBundle:Poste:indexStagiaire/content.html.twig', array(
            'entities'      => $postes,
            'stagiaire' => $stagiaire,
        ));                    
    }

}
