<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Explotic\AgendaBundle\Form\AgendaExtractType;
use Doctrine\Common\Collections\ArrayCollection;

class AgendaController extends Controller
{
    
    public function extractAction($user){
        
        $agenda = $this->get('explotic_admin.user.access_control')->findUserAgenda($user);
        
        $agendaExtractor = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $now= new \DateTime();
        $agendaExtractor->setYear((int)$now->format('o'));
        $agendaExtractor->setWeek((int)$now->format('W'));
        $agendaExtractor->setDuree(4);  
        $agendaExtractor->setAgendaEntities($agenda['entities']);
        
        $type = new \Explotic\AgendaBundle\Form\AgendaExtractType();
        $type->setAgendaList($agenda['ids']);

        $form =  $this->createForm($type, $agendaExtractor);  
        return $this->render('ExploticAgendaBundle:Agenda:extract.html.twig', array(
            'form'   => $form->createView(),
        ));
    }    
      
    public function showAction(Request $request){  
            
        $agendaExtractor = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $form = $this->createForm(new AgendaExtractType(), $agendaExtractor);
        
        $form->bind($request);

        if ($form->isValid()) {   
            return $this->showParamAction($agendaExtractor);
        }      
        else{
            throw new \Symfony\Component\Validator\Exception\InvalidArgumentException('Erreur dans le formulaire');
        }        
    } 
    
    public function showParamAction($agendaExtractor){
        
        $agendaViewer=  $this->buildAgenda($agendaExtractor);      
        
        return $this->render('ExploticAgendaBundle:Agenda:show.html.twig', array(
                'agenda'      => $agendaViewer,
                'agendaextractor'=> $agendaExtractor,
                ));               
    }
    
    public function buildAgenda($agendaExtractor){
        $em = $this->getDoctrine()->getManager();   
        $agendaExtractor->autoInitDates();
        $slots =new ArrayCollection(
                        $em->getRepository('ExploticAgendaBundle:CreneauRdv')
                                ->findByPeriod($agendaExtractor->getDateDebut(),$agendaExtractor->getDateFin())
                ); 

        $agendaViewer= new \Explotic\AgendaBundle\Model\Agenda();
        $agendaViewer->init($agendaExtractor->getWeek(),$agendaExtractor->getYear(),null,$agendaExtractor->getDuree());
        $rdvs = array();
        foreach($agendaExtractor->getAgendaEntities() as $agendaEntity){
            foreach($agendaEntity->getRdvs() as $rdv){
                $rdvs[]=$rdv;
            }
        }
        $agendaViewer->generateAgenda($slots,$rdvs, 420, 1140); 
        return $agendaViewer;
    }
        

    
}
