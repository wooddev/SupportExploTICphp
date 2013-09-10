<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Explotic\AgendaBundle\Generateurs\CreneauRdvGen;
use Explotic\AgendaBundle\Form\CreneauRdvGenType;

/**
 * CreneauRdvGen controller.
 *
 */
class CreneauRdvGenController extends Controller
{
     /**
     * Displays a form to generate CreneauRdv.
     *
     */
    public function generateAction()
    {
        
        $generateurRdv = new CreneauRdvGen();      
                
        $form   = $this->createForm(new CreneauRdvGenType(), $generateurRdv);

        return $this->render('ExploticAgendaBundle:CreneauRdv:generate.html.twig', array(
            'generateurRdv' => $generateurRdv,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new CreneauRdv Collection
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       
        
        $generateur = new CreneauRdvGen();
        $form = $this->createForm(new CreneauRdvGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){         

            $creneauxModeles = $em->getRepository('ExploticAgendaBundle:CreneauModele')->findAll();
            
            $generateur->setCreneauxModeles($creneauxModeles);
            
            $generateur->generateCreneauxRdvs($em->getRepository('ExploticAgendaBundle:CreneauRdv')); 
            $i=0;
            foreach ($generateur->getCreneauxRdvs() as $creneauRdv){
                $i++;
                $em->persist($creneauRdv);
                if($i==floor($i/10)*10){
                    $em->flush();
                }
            }    
            $em->flush();
            
        }
       
//        return $this->render('ExploticAgendaBundle:CreneauRdv:index.html.twig', array(
//            'entities'      => $generateur->getCreneauxRdvs()
//        ));
          return $this->redirect($this->generateUrl('creneaurdv'));

    }
    
}
