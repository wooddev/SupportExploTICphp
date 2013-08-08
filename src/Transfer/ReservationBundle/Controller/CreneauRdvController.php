<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Transfer\ReservationBundle\Entity\CreneauRdv;
use Transfer\ReservationBundle\Form\CreneauRdvType;
use Transfer\ReservationBundle\Form\CreneauRdvRechercheType;
use Transfer\ReservationBundle\Form\CreneauRdvRechercheListeType;
use Transfer\ReservationBundle\Recherche\RdvRecherche;

/**
 * CreneauRdv controller.
 *
 */
class CreneauRdvController extends Controller
{
    /**
     * Lists all CreneauRdv entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TransferReservationBundle:CreneauRdv')->findAll();

        return $this->render('TransferReservationBundle:CreneauRdv:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CreneauRdv entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauRdv:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new CreneauRdv entity.
     *
     */
    public function newAction()
    {
        $entity = new CreneauRdv();
        $form   = $this->createForm(new CreneauRdvType(), $entity);

        return $this->render('TransferReservationBundle:CreneauRdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CreneauRdv entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CreneauRdv();
        $form = $this->createForm(new CreneauRdvType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaurdv_show', array('id' => $entity->getId())));
        }

        return $this->render('TransferReservationBundle:CreneauRdv:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CreneauRdv entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $editForm = $this->createForm(new CreneauRdvType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TransferReservationBundle:CreneauRdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CreneauRdv entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CreneauRdvType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('creneaurdv_edit', array('id' => $id)));
        }

        return $this->render('TransferReservationBundle:CreneauRdv:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CreneauRdv entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TransferReservationBundle:CreneauRdv')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CreneauRdv entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('creneaurdv'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
    
    public function rechercheAction($semaine, $annee){       
               
        $entity = new RdvRecherche();
        $entity->setAnnee($annee); // Année au format ISO !!IMPORTANT POUR RESPECTER LA CODIFICATION ISO DES SEMAINES 
        $entity->setSemaine($semaine);
        $form   = $this->createForm(new CreneauRdvRechercheType(), $entity);
        $dateDebut = new \DateTime($annee.'W'.$semaine);
        $dateFin = new \DateTime($annee.'W'.$semaine."6");
        //Récupération du transporteur associé à l'utilisateur
        $transporteur = $this->get('transfer_profil.acces')->getTransporteur();
        
        
        return $this->render('TransferReservationBundle:CreneauRdv:recherche/formulaire.html.twig', array(
            'transporteur'=>$transporteur,
            'dateDebut'=> $dateDebut,
            'dateFin'=> $dateFin,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));      
    }  
    
    public function rechercheSupprimerAction(){       
               
        $entity = new CreneauRdv();
        $entity->setDateHeureDebut(new \DateTime(date('o').'W'.date('W')));
        $entity->setDateHeureFin(new \DateTime(date('o').'W'.date('W').'6'));        
        $form   = $this->createForm(new CreneauRdvRechercheListeType(), $entity);

        return $this->render('TransferReservationBundle:CreneauRdv:delete.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));      
    }  
    
    public function supprimerListeAction(Request $request){
        $creneauRecherche = new CreneauRdv();
        $form = $this->createForm(new CreneauRdvRechercheListeType(), $creneauRecherche);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $creneauRecherche
                    ->getDateHeureDebut()
                        ->setTime(
                                $creneauRecherche->getHeureDebut()->format('h'),
                                $creneauRecherche->getHeureDebut()->format('i') );    
            $creneauRecherche
                    ->getDateHeureFin()
                        ->setTime(
                                $creneauRecherche->getHeureFin()->format('H'),
                                $creneauRecherche->getHeureFin()->format('i') );
            $entities = $em->getRepository('TransferReservationBundle:CreneauRdv')->findRechercheListe($creneauRecherche);

            if (!$entities) {
                throw $this->createNotFoundException('Unable to find CreneauRdv entities.');
            }
            foreach($entities as $entity){
                $em->remove($entity);    
            }            
            $em->flush();
            
            return $this->redirect($this->generateUrl('creneaurdv'));
        }
        
        // recherche des créneaux => faire un repository 
        // (Attention : vérifier l'absence de rdv liés)
        
        // suppression de la liste récupérée
        
    }
        
}
