<?php

namespace Explotic\MainBundle\Controller;

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
                
        
        return $this->render('ExploticMainBundle:Default:monProfil.html.twig', array(
            'user' => $user,
        ));        
    }
}
