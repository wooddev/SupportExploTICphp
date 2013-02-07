<?php

namespace Explotic\PlanningBundle\Controller;

use Symfony\Bundle\frameworkBundle\Controller\Controller;
use Explotic\PlanningBundle\Entity\Jour;

class JourController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExploticPlanningBundle:Jour:index.html.twig');
    }
    
    public function voirAction()
    {
        
    }

    public function ajouterAction()
    {
        $jour = new Jour();
        $jour->setDateJour(new \DateTime("now"));
        
        $em= $this->getDoctrine()->getEntityManager();
        $em->persist($jour);
        $em->flush();
    }
}


?>
