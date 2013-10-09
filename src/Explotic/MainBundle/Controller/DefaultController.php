<?php

namespace Explotic\MainBundle\Controller;

use Ivory\GoogleMap\Overlays\Animation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ivory\GoogleMap\Controls\ControlPosition;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $mediaManager= $this->get('sonata.media.manager.media');
//        $mediaManager= new \Sonata\MediaBundle\Entity\MediaManager();
        $media=$mediaManager->findOneBy(array('name'=>'1470E'));      
        
//A VIRER : ///////////////////////////////////////////////
//        $kernel = $this->container->get('kernel');
//        $app = new Application($kernel);
//
//        $command = 'sonata:admin:generate-object-acl';        
//        $arguments=array();
//        $args = array_merge(array('command' => $command), $arguments);
//
//        $input = new ArrayInput($args);
//        $output = new NullOutput();        
//        
//        $app->doRun($input,$output);
//////////////////////////////////////////////////////////////:
        
        return $this->render('ExploticMainBundle:Default:index.html.twig',array(
            'media'=>$media,
            ));
    }
    
    public function monProfilAction(){
        
        // récupération de l'utilisateur courant et gestion des anonymes
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        if(! is_object($user))
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Veuillez vous authentifier');          
        }       
                
        $extractAgendaForm = $this->extractAgendaForm();
        $userClass=get_class($user);
        
 
        $myUserMap = new \Explotic\MainBundle\Model\MyUserMap(
                $this->get('ivory_google_map.map'), 
                $user, 
                $this->get('explotic_main.icopaths')->getPaths());  
               
        switch($userClass){
            case 'Explotic\TiersBundle\Entity\Stagiaire':
                $myUserMap->addProfil($user);
                break;
            case 'Explotic\TiersBundle\Entity\Gerant':
                $myUserMap->addProfil($user->getEntreprise()); 

                break;
            case 'Explotic\TiersBundle\Entity\Recruteur': 
                foreach($user->getEntreprises() as $entreprise){
                    $myUserMap->addProfil($entreprise);
                }
                break;
            case 'Explotic\TiersBundle\Entity\Formateur': 
                $myUserMap->addProfil($user->getOrganisme());
                break;
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
                  
          

        return $this->render('ExploticMainBundle:Default:monProfil.html.twig', array(
            'type'=> $userClass,
            'user' => $user,
            'extractAgendaForm'=>$extractAgendaForm->createView(),
            'map' => $myUserMap->getMap(),
        ));        
    }
    

    
    public function extractAgendaForm(){
        
        $agenda = $this->get('explotic_admin.user.access_control')->findCurrentUserAgenda();
        
        $agendaExtractor = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $now= new \DateTime();
        $agendaExtractor->setYear((int)$now->format('o'));
        $agendaExtractor->setWeek((int)$now->format('W'));
        $agendaExtractor->setDuree(4);  
        $agendaExtractor->setAgendaEntities($agenda['entities']);
        
        $type = new \Explotic\AgendaBundle\Form\AgendaExtractType();
        $type->setAgendaList($agenda['ids']);

        return $this->createForm($type, $agendaExtractor);
    }
}
