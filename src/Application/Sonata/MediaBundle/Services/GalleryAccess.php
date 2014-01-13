<?php

namespace Application\Sonata\MediaBundle\Services;
/**
 * User controller.
 *
 */
class GalleryAccess 
{
    /**
     * Lists all User entities.
     *
     */
    
    private $em;
    private $securityContext;
    
    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\Security\Core\SecurityContext $securityContext) {
        $this->em = $em;
        $this->securityContext = $securityContext;
    }
    
    public function getAuthorizedGalleries()
    {    
        $entities = $this->em->getRepository('ApplicationSonataMediaBundle:Gallery')->findAll();
        
        $authorizedGalleries = array();
        foreach($entities as $entity){
            if($this->controlAccessToGallery($entity)){
                $authorizedGalleries[]=$entity;
            }
        }
        return $authorizedGalleries;
    }    
    
    
    public function controlAccessToGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery){
        if($this->securityContext->isGranted('ROLE_ADMIN')){
            return true;
        }
        
        $role= $gallery->getMinRole();
        $authorization = $gallery->getAuthorization();        
                             
        if($this->securityContext->isGranted($role) or $role=='tous' or $role==''){
            if($authorization=='tous')
                return true;
            if($this->securityContext->isGranted('ROLE_STAGIAIRE') ){                
                $user = $this->securityContext->getToken()->getUser();
                foreach($user->getProgrammes() as $prog){
                    if(strpos( $authorization, $prog->getModule()->getReference())>=0){
                        return true;
                    } 
                }
            }else
                return true;  
        }      
        
        return false;
    }  

      
}
