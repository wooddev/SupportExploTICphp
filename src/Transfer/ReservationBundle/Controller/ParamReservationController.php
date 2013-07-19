<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\ParamReservation;
use Transfer\ReservationBundle\Form\ParamReservationType;

/**
 * ParamReservation controller.
 *
 */
class ParamReservationController extends Controller
{    
    public function initAction(){
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $arrayParamOld = $em->getRepository('TransferReservationBundle:ParamReservation')
                            ->findAll();
        
        foreach($arrayParamOld as $paramOld){
            $em->remove($paramOld);            
        }
        
        $paramReservation = new ParamReservation();
        $paramReservation->setParametres(array(
            "DisponibiliteTotale"=>2,
            'DisponibiliteFondMouvant'=>2,
            'DisponibiliteAutresTypes'=>1,
        ));        
        
        $paramReservation->setParametresReserves(array(
            'Transfer\ReservationBundle\Entity\CreneauRdv'=>array(
                'reservation'=>'Transfer\ReservationBundle\Entity\Rdv',
                'vidange'=>true,
                'evenement'=>true,
                'options'=>array()
                ),
            'Transfer\ReservationBundle\Entity\CreneauModele'=>array(
                'reservation'=>'Transfer\ReservationBundle\Entity\CreneauPref',
                'vidange'=>false,
                'evenement'=>false,
                'options'=>array(
                    'statut'=>array(
                        'entity'=>'Transfer\ReservationBundle\Entity\StatutCreneau',
                        'criteria'=>'nom',
                        'value'=>'Actif'),
                    'etatReservation'=>array(
                        'entity'=>'Transfer\ReservationBundle\Entity\EtatReservation',
                        'criteria'=>'nom',
                        'value'=>'A réserver')                                       
                    ))
        ));
        
        $em->persist($paramReservation);
        $em->flush();
        return $this->render('TransferReservationBundle:ParamReservation:show.html.twig', array(
            'entity'      => $paramReservation)); 
    }
    
    
    /**
     * Lists all ParamReservation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:ParamReservation')->findAll();

        return $this->render('TransferReservationBundle:ParamReservation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ParamReservation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new ParamReservation();
        $form = $this->createForm(new ParamReservationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paramreservation_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:ParamReservation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new ParamReservation entity.
     *
     */
    public function newAction()
    {
        $entity = new ParamReservation();
        $form   = $this->createForm(new ParamReservationType(), $entity);

        return $this->render('TransferReservationBundle:ParamReservation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ParamReservation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:ParamReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ParamReservation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:ParamReservation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ParamReservation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:ParamReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ParamReservation entity.');
        }

        $editForm = $this->createForm(new ParamReservationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:ParamReservation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ParamReservation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:ParamReservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ParamReservation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ParamReservationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paramreservation_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:ParamReservation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ParamReservation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:ParamReservation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ParamReservation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paramreservation'));
    }

    /**
     * Creates a form to delete a ParamReservation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
