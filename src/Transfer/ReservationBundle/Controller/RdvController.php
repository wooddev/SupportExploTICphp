<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\Rdv;
use Transfer\ReservationBundle\Form\RdvType;
use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ProfilBundle\Entity\Transporteur;
use Transfer\ReservationBundle\Entity\Evenement;

/**
 * Rdv controller.
 *
 */
class RdvController extends Controller
{
    /**
     * Lists all Rdv entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:Rdv')->findAll();

        return $this->render('TransferReservationBundle:Rdv:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    public function showTransporteur()
    {
       // récupérer ici la liste des rdv pour le transporteur associé à l'utilisateur en cours
       // Affichage dans un agenda avec typage associé aux événements? (au moins pour Réservé/confirmé/annulé)
    }

    /**
     * Finds and displays a Rdv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Rdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Rdv entity.
     *
     */
    public function newAction()
    {
        $entity = new Rdv();
        $form   = $this->createForm(new RdvType(), $entity);

        return $this->render('TransferReservationBundle:Rdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Rdv entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Rdv();
        $form = $this->createForm(new RdvType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:Rdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Rdv entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $editForm = $this->createForm(new RdvType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:Rdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Rdv entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RdvType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:Rdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Rdv entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:Rdv')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rdv entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rdv'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function reservationAction(Request $request){
        $rdvRecherche = new CreneauRdv();
        $form = $this->createForm(new CreneauRdvType(), $rdvRecherche);
        $form->bind($request);
        $em = $this->getDoctrine()->getManager();
        $creneauxRdvBruts = $em->getRepository('TransferReservationBundle:CreneauRdv')
                                ->findByRecherche($rdvRecherche);
        
        $creneauxRdvTries = new \Transfer\MainBundle\Model\Sorter();
        
        foreach ($creneauxRdvBruts as $creneauRdvBrut){
            $creneauxRdvTries->add(new \Transfer\ReservationBundle\Recherche\RdvResultat($creneauRdvBrut,$rdvRecherche));            
        }
        
        //Récupération du transporteur associé à l'utilisateur
        // A FAIRE !!
        // TRANSPORTEUR PAR DEFAUT POUR L'INSTANT
        $transporteur = $em->getRepository('TransferProfilBundle:Transporteur')
                                ->find(1);
        
        foreach ($creneauxRdvTries->sortArray('getDiffTemps') as $creneauRdv){
            $creneauRdvSync = $em->getRepository('TranferReservationBundle:CreneauRdv')->find($creneauRdv->getId());
            if ($creneauRdvSync->getDisponibilite() > 0){
                //On bloque le créneau tout de suite
                $creneauRdvSync->setDisponibilite($creneauRdvSync->getDisponibilite()-1);
                $em->persist($creneauRdvSync);
                $em->flush();                                
                // création du rdv
                $rdv = new \Transfer\ReservationBundle\Entity\Rdv();
                $rdv->init($creneauRdvSync);
                // Création de l'évenement de réservation
                $evenement = new Evenement();
                $evenement->setRdv($rdv);
                $evenement->setTransporteur($transporteur);
                $evenement->setType('reservation');
                
                $em->persist($rdv);
                $em->persist($evenement);
                $em->flush();
                return $this->redirect($this->generateUrl('rdv_transporteur'));
            }
        }
        return $this->render('TransferReservationBundle:CreneauRdv:recherche/echec.html.twig');
    }
}
