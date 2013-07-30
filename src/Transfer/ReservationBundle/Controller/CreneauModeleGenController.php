<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauModele;
use Transfer\ReservationBundle\Form\CreneauModeleType;
use Transfer\ReservationBundle\Form\CreneauModeleGenType;

/**
 * CreneauModele controller.
 *
 */
class CreneauModeleGenController extends Controller
{
     /**
     * Displays a form to generate CreneauModele.
     *
     */
    public function generateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $this->get('transfer_reservation.generateur.creneau_modele');
        $entity->init(6,0, 0, 19, 25,2, 
                        $em->getRepository('TransferReservationBundle:TypePoste')->find(1),          
                        $em->getRepository('TransferReservationBundle:StatutCreneau')->find(1));           
        $form   = $this->createForm(new CreneauModeleGenType(), $entity);

        return $this->render('TransferReservationBundle:CreneauModele:generate.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates CreneauModele entities.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();                      
      
        $generateur = $this->get('transfer_reservation.generateur.creneau_modele');
        $form = $this->createForm(new CreneauModeleGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){
            $creneauxOld = $em->getRepository('TransferReservationBundle:CreneauModele')
                                    ->findByTypePoste($generateur->getTypePoste());
        
            foreach($creneauxOld as $creneau){
                $em->remove($creneau);
            }

            $em->flush();
            $generateur->setStatut($em->getRepository('TransferReservationBundle:StatutCreneau')->find(1));
            $generateur->generate();  
            
            foreach ($generateur->getCreneauxModeles() as $creneauModele){
                $em->persist($creneauModele);
            }        
            $em->flush();  
        }
       
        return $this->render('TransferReservationBundle:CreneauModele:index.html.twig', array(
            'entities'      => $generateur->getCreneauxModeles()
        ));
    }

    /**
     * Displays a form to edit an existing CreneauModele entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauModele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauModele entity.');
        }

        $editForm = $this->createForm(new CreneauModeleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauModele:edit.html.twig', array(
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

        $entity = $em->getRepository('TransferReservationBundle:CreneauModele')->find($id);

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

        return $this->render('TransferReservationBundle:CreneauModele:edit.html.twig', array(
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
            $entity = $em->getRepository('TransferReservationBundle:CreneauModele')->find($id);

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
