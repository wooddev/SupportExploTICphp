<?php

namespace Explotic\MainBundle\Controller;

use Ivory\GoogleMap\Overlays\Animation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ivory\GoogleMap\Controls\ControlPosition;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExploticMainBundle:Default:index.html.twig');
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
        $agenda = new \Explotic\MainBundle\Model\Agenda();        
        $agenda->init((int)date('W'), (int) date('Y'));        
            //Recherche des jours figurant dans cette partie du calendrier   
        if (!(null===$user->getStagiaire()->getCalendrier())){
            $jours = $em->getRepository('ExploticPlanningBundle:Jour')
                        ->findByCalendrierAndDate(
                                $user->getStagiaire()->getCalendrier()->getId(),
                                $agenda->getDateDebut(),
                                $agenda->getDateFin()
                      );           
        } else{
            $jours = null;
        }
        // Conception de la carte
        
        $myUserMap = new \Explotic\MainBundle\Model\MyUserMap($this->get('ivory_google_map.map'), $user);       
       
        if (!(null===$user->getEntreprise())){
            $myUserMap->addProfil($user->getEntreprise());
        }
        if (!(null===$user->getStagiaire())){
            $myUserMap->addProfil($user->getStagiaire());
        }
        $myUserMap->addMarkersToGMaps();
        
        $myUserMap->getMap()->setStylesheetOptions(array(
            'width'=>'915px',
            'height'=>'450px',
            ));
        
        $myUserMap->getMap()->setPanControl('top_left');
        $myUserMap->getMap()->setRotateControl(ControlPosition::BOTTOM_LEFT);
        $myUserMap->getMap()->setZoomControl('top_left','default');
        $myUserMap->getMap()->setScaleControl('bottom_left','default');
        $myUserMap->getMap()->setMapTypeControl(
                array('roadmap','satellite'),
                'top_right',
                'default');
        $myUserMap->getMap()->setStreetViewControl('top_left');
        

        
        return $this->render('ExploticMainBundle:Default:monProfil.html.twig', array(
            'user' => $user,
            'agenda'=>$agenda->generate($jours),
            'map' => $myUserMap->getMap(),
        ));        
    }
}
