<?php

namespace Explotic\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\AgendaBundle\Generateurs\CreneauModeleGen;
use Explotic\AgendaBundle\Form\CreneauModeleGenType;

/**
 * CreneauModele controller.
 *
 */
class CreneauModeleGenController extends Controller
{
     /**
     * Displays a form to generate CreneauModele.
     *
     */
    public function generateAction()
    {
        $entity = new CreneauModeleGen();
        $entity->init(8,0, 12, 0, 240);           
        $form   = $this->createForm(new CreneauModeleGenType(), $entity);

        return $this->render('ExploticAgendaBundle:CreneauModele:generate.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new CreneauModele entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $generateur = new CreneauModeleGen();
        $form = $this->createForm(new CreneauModeleGenType(), $generateur);
        $form->bind($request);        
        
        if ($form->isValid()){

            $em->flush();           
                        
            $generateur->generate();        
            foreach ($generateur->getCreneauxModels() as $creneauModele){
                $em->persist($creneauModele);
            }        
            $em->flush();  
        }
       
        return $this->render('ExploticAgendaBundle:CreneauModele:index.html.twig', array(
            'entities'      => $generateur->getCreneauxModels()
        ));
    }


}
