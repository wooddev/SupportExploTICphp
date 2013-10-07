<?php

namespace Application\Sonata\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\MediaBundle\Controller\MediaController as BaseController;
/**
 * User controller.
 *
 */
class MediaController extends BaseController
{       
    public function showAction($id,$galId){        
        
        $em = $this->getDoctrine()->getManager();
        
        $media = $em->getRepository('ApplicationSonataMediaBundle:Media')->find($id);
        
        $gallery = $em->getRepository('ApplicationSonataMediaBundle:Gallery')->find($galId);
        
        if(!$media or !$gallery){
            throw new \Doctrine\ORM\NoResultException('La ressource demandée est introuvable'); 
        }        
        
        return $this->render("ApplicationSonataMediaBundle:Media:show.html.twig",array(
            'media'=>$media,
            'gallery'=>$gallery,
        ));
    }
   
    
}
