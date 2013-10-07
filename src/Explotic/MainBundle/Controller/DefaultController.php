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
        
        $extractAgendaForm = $this->extractAgendaForm($user);
        
        
        $myUserMap = new \Explotic\MainBundle\Model\MyUserMap($this->get('ivory_google_map.map'), $user);       
       
        if (!(null===$user->getEntreprise())){
            $myUserMap->addProfil($user->getEntreprise());
        }
        if (!(null===$user->hasRole('ROLE_STAGIAIRE'))){
            $myUserMap->addProfil($user);
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
            'user' => $user,
            'extractAgendaForm'=>$extractAgendaForm->createView(),
            'map' => $myUserMap->getMap(),
        ));        
    }
    
    
    public function extractAgendaForm($user){

        
        $calendrierListe = new \Doctrine\Common\Collections\ArrayCollection();
        
        // Génération de l'agenda pour la semaine en cour, comme les 
       
        if ($user->getCalendrier()){
        $calendrierListe->add($user->getCalendrier());            
        }
        if ($user->getSessions()){
            foreach($user->getSessions() as $session){

                if($session->getInterventionEntreprise()){
                    $nom = array(   "Formation" => $session->getInterventionEntreprise()->getNom(),
                                    "Etape" => $session->getInterventionEntreprise()->getStade()
                        );                                               
                }elseif($session->getInterventionSalle()){
                    $nom = array(   "Formation" => $session->getInterventionSalle()->getNom(),
                                    "Jour" => $session->getInterventionSalle()->getStade(),                                         
                        );
                }
                $calendrierListe->add($session->getCalendrier());
            }
        }        
        $agendaExtractor = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $now= new \DateTime();
        $agendaExtractor->setYear((int)$now->format('o'));
        $agendaExtractor->setWeek((int)$now->format('W'));
        $agendaExtractor->setDuree(4);  
        $agendaExtractor->setAgendaEntities($calendrierListe);
        
        return $this->createForm(new \Explotic\AgendaBundle\Form\AgendaExtractType(), $agendaExtractor);
        
    }
}
