<?php
namespace Application\Sonata\MediaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        
        return $this->render('ApplicationSonataMediaBundle:Main:homepage.html.twig');
    }
}

?>
