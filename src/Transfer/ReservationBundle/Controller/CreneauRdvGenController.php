<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauModele;
use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ReservationBundle\Generateurs\CreneauRdvGen;
use Transfer\ReservationBundle\Form\CreneauRdvGenType;


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
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')->findAll();
        
        $generateurRdv = new CreneauRdvGen();
        $generateurRdv->init($creneauxModeles, 1, 2013);     
                
        $form   = $this->createForm(new CreneauRdvGenType(), $generateurRdv);

        return $this->render('TransferReservationBundle:CreneauRdv:generate.html.twig', array(
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

        
//        Version sans formulaire, à partir du constructeur modifié
//        $posteAutonome = $em->getRepository('TransferReservationBundle:TypePoste')->find(1);
//        $generateur  = new CreneauModeleGen(6,0, 0, 19, 20,$posteAutonome->getDisponibilite() , $posteAutonome);                
// 
        
        
        $generateur = new CreneauRdvGen();
        $form = $this->createForm(new CreneauRdvGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){            
           

            $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            
            $generateur->generateCreneauxRdvs(); 
            
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                $em->persist($creneauRdv);
            }        
            $em->flush();  
        }
       
        return $this->render('TransferReservationBundle:CreneauRdv:index.html.twig', array(
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
