<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Explotic\AgendaBundle\Form\AgendaExtractType;
use Doctrine\Common\Collections\ArrayCollection;

class AgendaController extends Controller
{
    
    public function extractAction(){
        
        $entity = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $now= new \DateTime();
        $entity->setYear((int)$now->format('o'));
        $entity->setWeek((int)$now->format('W'));
        $entity->setDuree= 4;        
        
        $form = $this->createForm(new AgendaExtractType(), $entity);
        
        return $this->render('ExploticAgendaBundle:Agenda:extract.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }    
    
    public function showParamAction($agendaExtractor){
        
        $agendaViewer=  $this->buildAgenda($agendaExtractor);      
        
        return $this->render('ExploticAgendaBundle:Agenda:show.html.twig', array(
                'agenda'      => $agendaViewer,
                'agendaextractor'=> $agendaExtractor,
                ));               
    }
    
    public function showAction(Request $request){  
            
        $agendaExtractor = new \Explotic\AgendaBundle\Model\AgendaExtractor();
        $form = $this->createForm(new AgendaExtractType(), $agendaExtractor);
        
        $form->bind($request);

        if ($form->isValid()) {   
            $this->showParamAction($agendaExtractor);
        }      
        else{
            throw new \Symfony\Component\Validator\Exception\InvalidArgumentException('Erreur dans le formulaire');
        }        
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
        $agendaViewer->generateAgenda($slots, $agendaExtractor->getAgendaEntity()->getRdvs(), 420, 1140);    
        
        return $agendaViewer;
    }
        

    
}
