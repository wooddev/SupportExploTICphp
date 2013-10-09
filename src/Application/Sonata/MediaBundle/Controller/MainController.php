<?php
namespace Application\Sonata\MediaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainController
 *
 * @author adrien
 */
class MainController extends Controller{
    
    
    public function mediaHomepageAction(){   
        $galleries = new ArrayCollection($this->container->get('application.gallery_access')->getAuthorizedGalleries());
        
        $criteria  = Criteria::create()->where(Criteria::expr()->isNull('parent')); 
        
        $masterGalleries = $galleries->matching($criteria);
        
        return $this->render('ApplicationSonataMediaBundle:Main:homepage.html.twig', array(
            'galleries'=>$masterGalleries,
        ));
    }
}

?>
