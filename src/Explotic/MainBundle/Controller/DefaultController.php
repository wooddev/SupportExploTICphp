<?php

namespace Explotic\MainBundle\Controller;

use Ivory\GoogleMap\Overlays\Animation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        
        $map = $this->get('ivory_google_map.map');
        
        if (!is_null($user->getEntreprise())){
            $marker = $this->get('ivory_google_map.marker');
            $marker->setPosition(
                                $user  ->getEntreprise()
                                        ->getBureau()
                                        ->getLocalisation()
                                        ->getGeometry()
                                        ->getLat(),
                                $user   ->getEntreprise()
                                        ->getBureau()
                                        ->getLocalisation()
                                        ->getGeometry()
                                        ->getLon(),
                                true);
            $marker->setIcon('../bundles/exploticmain/images/workoffice.png');
            $map->addMarker($marker);
        }       
        if (!is_null($user->getStagiaire()))
        {       
            if (!is_null($user->getStagiaire()->getPostes()))
            {       
                if (count($user->getStagiaire()->getPostes())>0)
                {            
                    foreach ($user->getStagiaire()->getPostes() as $poste)
                    {
                    $marker = $this->get('ivory_google_map.marker');
                    $marker->setPosition(   $poste                               
                                            ->getLocalisation()
                                            ->getGeometry()
                                            ->getLat(),
                                            $poste
                                            ->getLocalisation()
                                            ->getGeometry()
                                            ->getLon(),
                                    true);
                    $marker->setIcon('../bundles/exploticmain/images/forest2.png');
                    $map->addMarker($marker);
                    }
                }
            }
            if (!is_null($user->getStagiaire()->getEntreprise()))                      
            {       
                $marker = $this->get('ivory_google_map.marker');
                $marker->setPosition(
                                    $user   ->getStagiaire()
                                            ->getEntreprise()
                                            ->getBureau()
                                            ->getLocalisation()
                                            ->getGeometry()
                                            ->getLat(),
                                    $user   ->getStagiaire()
                                            ->getEntreprise()
                                            ->getBureau()
                                            ->getLocalisation()
                                            ->getGeometry()
                                            ->getLon(),
                                    true);
                $marker->setIcon('../bundles/exploticmain/images/workoffice.png');
                $map->addMarker($marker);
            }
            
        }             
                        
        
        return $this->render('ExploticMainBundle:Default:monProfil.html.twig', array(
            'user' => $user,
            'map' => $map,
        ));        
    }
}
