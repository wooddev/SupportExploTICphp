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
        
        
//        // Génération de l'agenda pour la semaine en cours
//
//        if (!(null===$user->getStagiaire())){
//            if (!(null===$user->getStagiaire()->getCalendrier())){        
//            $CalendrierStg =  $user->getStagiaire()->getCalendrier();
//            $agendaStg = $this->container->get('explotic_planning.agenda_generator')->makeAgenda(array($CalendrierStg), time(), 4);
//            }
//        }    

        // Conception de la carte
        
        $myUserMap = new \Explotic\MainBundle\Model\MyUserMap($this->get('ivory_google_map.map'), $user);       
       
        if (!(null===$user->getEntreprise())){
            $myUserMap->addProfil($user->getEntreprise());
        }
        if (!(null===$user->getStagiaire())){
            $myUserMap->addProfil($user->getStagiaire());
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
//            'agenda'=>$agendaStg,
            'map' => $myUserMap->getMap(),
        ));        
    }
    
    
    public function monAgendaAction(){
        $user = $this->container->get('security.context')->getToken()->getUser();
        if(! is_object($user))
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException('Veuillez vous authentifier');          
        }
        
        $calendrierListe = new \Doctrine\Common\Collections\ArrayCollection();
        
        // Génération de l'agenda pour la semaine en cour, comme les 
       
        if (!(null===$user->getStagiaire())){
            $stagiaire = $user->getStagiaire();
            if (!(null===$stagiaire->getCalendrier())){        
            $idCalendrierStg =  $user->getStagiaire()->getCalendrier();
            $calendrierListe->add(array("id"=>$idCalendrierStg,"nom"=> array("1"=>"Disponible")));            
            }
            if (!(null==$stagiaire->getSessions())){
                foreach($stagiaire->getSessions() as $session){
                    
                    if(!(null===$session->getInterventionEntreprise())){
                        $nom = array(   "Formation" => $session->getInterventionEntreprise()->getNom(),
                                        "Etape" => $session->getInterventionEntreprise()->getStade()
                            );                                               
                    }elseif(!(null===$session->getInterventionSalle())){
                        $nom = array(   "Formation" => $session->getInterventionSalle()->getNom(),
                                        "Jour" => $session->getInterventionSalle()->getStade(),                                         
                            );
                    }
                    $calendrierListe->add(array("id"=>$session->getCalendrier(),"nom"=>$nom));
                }
            }
        }  
        
        $agenda = $this->container->get('explotic_planning.agenda_generator')->makeAgenda($calendrierListe, time(), 4);
        
        return $this->render('ExploticMainBundle:Default:monAgenda.html.twig', array(
            'agenda'=>$agenda,
        ));

        
    }
}
