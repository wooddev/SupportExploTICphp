<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Explotic\AgendaBundle\Generateurs\CreneauRdvGen;
use Explotic\AgendaBundle\Form\CreneauRdvGenType;

/**
 * CreneauRdvGen controller.
 *
 */
class CreneauRdvGenController extends Controller
{
     /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction()
    {
        
        $generateurRdv = new CreneauRdvGen();      
                
        $form   = $this->createForm(new CreneauRdvGenType(), $generateurRdv);

        return $this->render('ExploticAgendaBundle:CreneauRdv:generate.html.twig', array(
            'generateurRdv' => $generateurRdv,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new CreneauRdv Collection
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
       
        
        $generateur = new CreneauRdvGen();
        $form = $this->createForm(new CreneauRdvGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){         

            $creneauxModeles = $em->getRepository('ExploticAgendaBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            
            $generateur->generateCreneauxRdvs($em->getRepository('ExploticAgendaBundle:CreneauRdv')); 
            $i=0;
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                $i++;
                $em->persist($creneauRdv);
                if($i==floor($i/10)*10){
                    $em->flush();
                }
            }    
            $em->flush();
            
        }
       
        return $this->render('ExploticAgendaBundle:CreneauRdv:index.html.twig', array(
            'entities'      => $generateur->getCreneauxRdvs()
        ));
    }

    /**
     * Displays a form to edit an existing CreneauModele entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAgendaBundle:CreneauModele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauModele entity.');
        }

        $editForm = $this->createForm(new CreneauModeleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticAgendaBundle:CreneauModele:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CreneauModele entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticAgendaBundle:CreneauModele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauModele entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CreneauModeleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaumodele_edit', array('id' => $id)));
        }

        return $this->render('ExploticAgendaBundle:CreneauModele:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CreneauModele entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticAgendaBundle:CreneauModele')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CreneauModele entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('creneaumodele'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
}
