<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ExploticAgendaBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function cleanAgendaAction(){
        
        
        $em= $this->getDoctrine()->getManager();
        
        $rdvs = $em->getRepository('ExploticAgendaBundle:Rdv')->findAll();
        $creneauxRdvs = $em->getRepository('ExploticAgendaBundle:CreneauRdv')->findAll();
        $creneauxModeles= $em->getRepository('ExploticAgendaBundle:CreneauModele')->findAll();
        
        foreach($rdvs as $rdv){
            $em->remove($rdv);
        }
        $em->flush();
        foreach($creneauxRdvs as $cr){
            $em->remove($cr);
        }
        $em->flush();
        foreach($creneauxModeles as $cm){
            $em->remove($cm);
        }
        $em->flush();
        
        return $this->redirect($this->generateUrl('homepage'));
        
        
    }
    
}
