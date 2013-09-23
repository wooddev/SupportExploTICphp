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
        if($this->securityContext->isGranted('ROLE_FORMATEUR')){
            return true;
        }
        if($this->securityContext->isGranted('ROLE_RECRUTEUR')){
            return true;
        }
        if($this->securityContext->isGranted('ROLE_STAGIAIRE')){      
            $user = $this->securityContext->getToken()->getUser();
            foreach($user->getProgrammes() as $prog){
                if($prog->getModule()->getReference()==$gallery->getAuthorization()){
                    return true;
                }  
            }     
        }
        return false;
    }  

      
}
