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
        
        if(! is_object($user))
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Veuillez vous authentifier');          
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
        
                // Intégration des markers
//        //Entreprise
//        if (!is_null($user->getEntreprise())){
//            $marker = $this->get('ivory_google_map.marker');
//            $marker->setPosition(
//                                $user  ->getEntreprise()
//                                        ->getBureau()
//                                        ->getLocalisation()
//                                        ->getGeometry()
//                                        ->getLat(),
//                                $user   ->getEntreprise()
//                                        ->getBureau()
//                                        ->getLocalisation()
//                                        ->getGeometry()
//                                        ->getLon(),
//                                true);
//            $marker->setIcon('../bundles/exploticmain/images/workoffice.png');
//            $map->addMarker($marker);
//        }    
//        //Stagiaire
//        if (!is_null($user->getStagiaire()))
//        {       
//            if (!is_null($user->getStagiaire()->getPostes()))
//            {       
//                if (count($user->getStagiaire()->getPostes())>0)
//                {            
//                    foreach ($user->getStagiaire()->getPostes() as $poste)
//                    {
//                    $marker = $this->get('ivory_google_map.marker');
//                    $marker->setPosition(   $poste                               
//                                            ->getLocalisation()
//                                            ->getGeometry()
//                                            ->getLat(),
//                                            $poste
//                                            ->getLocalisation()
//                                            ->getGeometry()
//                                            ->getLon(),
//                                    true);
//                    $marker->setIcon('../bundles/exploticmain/images/forest2.png');
//                    $map->addMarker($marker);
//                    }
//                }
//            }
//            if (!is_null($user->getStagiaire()->getEntreprise()))                      
//            {       
//                $marker = $this->get('ivory_google_map.marker');
//                $marker->setPosition(
//                                    $user   ->getStagiaire()
//                                            ->getEntreprise()
//                                            ->getBureau()
//                                            ->getLocalisation()
//                                            ->getGeometry()
//                                            ->getLat(),
//                                    $user   ->getStagiaire()
//                                            ->getEntreprise()
//                                            ->getBureau()
//                                            ->getLocalisation()
//                                            ->getGeometry()
//                                            ->getLon(),
//                                    true);
//                $marker->setIcon('../bundles/exploticmain/images/workoffice.png');
//                $map->addMarker($marker);
//            }
//            
//        } 
        
        return $this->render('ExploticMainBundle:Default:monProfil.html.twig', array(
            'user' => $user,
            'map' => $myUserMap->getMap(),
        ));        
    }
}
