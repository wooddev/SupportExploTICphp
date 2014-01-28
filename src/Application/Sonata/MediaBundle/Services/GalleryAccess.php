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
    
    public function getAuthorizedChildGalleries($masterGallery){
                
        $authorizedGalleries = array();
        foreach($masterGallery->getChildren() as $entity){
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
              
        if($role=='ROLE_STAGIAIRE'){ // Contrôle spécifique aux galleries role_stagiaire
            if($this->securityContext->isGranted('ROLE_GERANT') ) // On autorise l'accès aux gérants sur les galleries ROLE_STAGIAIRE
                return true;            
            elseif($this->securityContext->isGranted('ROLE_STAGIAIRE') ){
                if($authorization=='tous' or $authorization=='-' or $authorization=='' )
                    return true;
                
                $user = $this->securityContext->getToken()->getUser();
                foreach($user->getProgrammes() as $prog){
                    if(stristr( $authorization, $prog->getModule()->getReference())){
                        return true;
                    }
                }
                return false;
            }

            
        }elseif($this->securityContext->isGranted($role) or $role=='tous' or $role=='' or $role=='-'){ // tous les autres cas
            if($authorization=='tous' or $authorization=='-' or $authorization=='' )
                return true;
            if($this->securityContext->isGranted('ROLE_GERANT')){
                return true;
            }
            if($this->securityContext->isGranted('ROLE_STAGIAIRE') ){                
                $user = $this->securityContext->getToken()->getUser();
                foreach($user->getProgrammes() as $prog){                    
                    if(stristr( $authorization, $prog->getModule()->getReference())){
                        return true;
                    }                
                }
                return false;
            }                
            return true;  
        }   
        
        return false;
    }  

      
}
