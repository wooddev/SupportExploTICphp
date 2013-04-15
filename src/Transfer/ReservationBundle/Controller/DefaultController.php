<?php

namespace Transfer\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default controller.
 *
 */
class DefaultController extends Controller
{
    public function resetFormAction(){                
        return $this->render('TransferReservationBundle:Default:reset.html.twig');
    }
    
    public function resetReservationAction(){
       $em = $this->getDoctrine()->getManager();
       $evenements = $em->getRepository('TransferReservationBundle:Evenement')
                                ->findAll();
       $rdvs = $em->getRepository('TransferReservationBundle:Rdv')
                                ->findAll();
       $creneauxRdvs = $em->getRepository('TransferReservationBundle:CreneauRdv')
                                ->findAll();
       
       $creneauxPrefs = $em->getRepository('TransferReservationBundle:CreneauPref')
                                ->findAll();

       $creneauxModeles = $em->getRepository('TransferReservationBundle:CreneauModele')
                                ->findAll();
       
       foreach ($evenements as $entity){
           $em->remove($entity);
       }
       $em->flush();
       foreach ($rdvs as $entity){
           $em->remove($entity);
       }
       $em->flush();
       foreach ($creneauxRdvs as $entity){
           $em->remove($entity);
       }
       $em->flush();
       foreach ($creneauxPrefs as $entity){
           $em->remove($entity);
       }
       $em->flush();
       foreach ($creneauxModeles as $entity){
           $em->remove($entity);
       }
       $em->flush();
       
       return $this->redirect($this->generateUrl('homepage')); 
       
   }
}
