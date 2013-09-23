<?php

namespace Application\Sonata\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\MediaBundle\Controller\GalleryController as BaseController;
/**
 * User controller.
 *
 */
class GalleryController extends BaseController
{       
    public function showAction($id){        
        
        $em = $this->getDoctrine()->getManager();
        
        $gallery = $em->getRepository('ApplicationSonataMediaBundle:Gallery')->find($id);
        
        if(!$gallery){
            throw new \Doctrine\ORM\NoResultException('La ressource demandée est introuvable'); 
        }
        
        if(!$this->get('application.gallery_access')->controlAccessToGallery($gallery)){
            throw new \Symfony\Component\Finder\Exception\AccessDeniedException('Vous n\'avez pas l\'autorisation d\'accèder à ce contenu !');
        }
        
        return $this->render("ApplicationSonataMediaBundle:Gallery:show.html.twig",array(
            'gallery'=>$gallery,
        ));
    }
   
    
}
