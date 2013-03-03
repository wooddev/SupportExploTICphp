<?php

namespace Transfer\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TransferMainBundle:Default:index.html.twig');
    }
    
    public function monProfilAction(){
        
        // récupération de l'utilisateur courant et gestion des anonymes
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em=$this->getDoctrine()->getManager();
        if(! is_object($user))
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Veuillez vous authentifier');          
        }
        // Génération de l'agenda pour la semaine en cours
        $agenda = new \Transfer\MainBundle\Model\Agenda();        
        $agenda->init((int)date('W'), (int) date('Y'));        
        //Recherche des jours figurant dans cette partie du calendrier  
        $jours = $em->getRepository('TransferReservationBundle:RDV')
                        ->findByCalendrierAndDate($user->getStagiaire()->getCalendrier()->getId(),$agenda->getDateDebut(),$agenda->getDateFin()); 
        
        
        
        return $this->render('TransferMainBundle:Default:monProfil.html.twig', array(
            'user' => $user,
            'agenda'=>$agenda->generate($jours),
        ));        
    }
}
