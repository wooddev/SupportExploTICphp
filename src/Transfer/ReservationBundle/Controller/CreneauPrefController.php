<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauPref;
use Transfer\ReservationBundle\Form\CreneauPrefType;

/**
 * CreneauPref controller.
 *
 */
class CreneauPrefController extends Controller
{
    /**
     * Lists all CreneauPref entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:CreneauPref')->findAll();

        return $this->render('TransferReservationBundle:CreneauPref:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CreneauPref entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauPref')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauPref entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauPref:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    
    /**
     * Affiche les créneaux prefs pour 1 semaine et 1 transporteur
     *
     */
    public function showTransporteurAction($idTransporteur)
    {
        $em = $this->getDoctrine()->getManager();

        $crModeles = $em->getRepository('TransferReservationBundle:CreneauModele')
                            ->findAll();
                            //->findByNomStatut('Actif');
        $crPrefs = $em->getRepository('TransferReservationBundle:CreneauPref')
                            ->findAll();
                            //->findActifsByTransporteur($idTransporteur);
        
        $agenda = new \Transfer\MainBundle\Model\Agenda();
        
        $agenda->init(1,2000);
        $agenda->setCreneauxAgenda($crModeles, $crPrefs);
        $agenda->generateAgenda(1);
        
        return $this->render('TransferReservationBundle:CreneauPref:show/agenda.html.twig', array(
            'agenda'      => $agenda,
            ));
    }

    /**
     * Displays a form to create a new CreneauPref entity.
     *
     */
    public function newAction()
    {
        $entity = new CreneauPref();
        $form   = $this->createForm(new CreneauPrefType(), $entity);

        return $this->render('TransferReservationBundle:CreneauPref:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CreneauPref entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CreneauPref();
        $form = $this->createForm(new CreneauPrefType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaupref_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:CreneauPref:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CreneauPref entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauPref')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauPref entity.');
        }

        $editForm = $this->createForm(new CreneauPrefType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauPref:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CreneauPref entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauPref')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauPref entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CreneauPrefType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaupref_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:CreneauPref:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CreneauPref entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:CreneauPref')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CreneauPref entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('creneaupref'));
    }

    public function resetAction(){
        $em=$this->getDoctrine()->getManager();
        $entities = $em->getRepository('TransferReservationBundle:CreneauPref')->findAll();
        foreach($entities as $entity){
            $em->remove($entity);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('creneaupref'));
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    /**
     * NON UTILISE POUR L'INSTANT
     * @param type $transporteur_id
     * @return type
     */
    public function newToTransporteur($transporteur_id){
        $em = $this->getDoctrine()->getManager();
        
        $transporteur = $em->getRepository('TransferReservationBundle:Transporteur')
                ->find($transporteur_id);
        $entity = new CreneauPref();        
        $entity ->setTransporteur($transporteur)
                ->setEtatReservation($em->getRepository('TransferReservationBundle:EtatReservation')
                ->findByNom('A réserver'))   ; 
        
        $form   = $this->createForm(new CreneauPrefType(), $entity);

        return $this->render('TransferReservationBundle:CreneauPref:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        
        
    }
}
