<?php

namespace Explotic\PlanningBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Explotic\PlanningBundle\Entity\Calendrier;
use Explotic\PlanningBundle\Form\CalendrierType;

/**
 * Calendrier controller.
 *
 */
class CalendrierController extends Controller
{
    /**
     * Lists all Calendrier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticPlanningBundle:Calendrier')->findAll();

        return $this->render('ExploticPlanningBundle:Calendrier:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Calendrier entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Calendrier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calendrier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:Calendrier:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    /**
     * Finds and displays a Calendrier entity.
     *
     */
    public function showWeekAction($id,$week,$year)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Calendrier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calendrier entity.');
        }
        
        // On crée les dates du calendrier dans un tableau
        
        $dates = array();
        
        // Le calendrier s'étale sur 4 semaines
        for ($s = $week; $s<=$week+4 && $s<=52; $i++)
        {
            for($j=1; $j<=5;$j++)
            {
                $dates[$year][$s][$j]['Mat'] = null;
                $dates[$year][$s][$j]['ApM']=null;
            }
        }
        //On gère la fin d'année ici
        if($week>48)
        {
            for ($s = 1; $s<=$week+4-52; $i++)
            {
                for($j=1; $j<=5;$j++)
                {
                    $dates[$year+1][$s][$j]['Mat'] = null;
                    $dates[$year+1][$s][$j]['ApM']=null;
                }
            }
            
        }
        
        // Calcul des dates de début et fin correspondate
        $dateDebut = new \DateTime();
        $dateDebut->setISODate($year,$week);
        
        $dateFin = new \DateTime();
        if($week>48){ // gestion de la fin d'année ici aussi
            $dateFin->setISODate($year+1,$week+4-52);
        }else $dateFin->setISODate($year,$week+4);       
          
        // On recherche les jours figurant dans ce calendrier
        $jours = $em->getRepository('ExploticPlanningBundle:Jour')
                        ->findByCalendrierAndDate($entity,$dateDebut,$dateFin);
        
        // On lie les jours récupérés au tableau des dates
        if(!(null===$jours))
        {
            foreach($jours as $jour)
            {
                $dates  [idate('Y',$jour->getCreneauDebut)]
                        [idate('W',$jour->getCreneauDebut)]
                        [idate('w',$jour->getCreneauDebut)]
                        [$jour->getCreneau()]
                        = $jour;
            }
        }
        
        
        
        return $this->render('ExploticPlanningBundle:Calendrier:show/week.html.twig', array(
            'entity'      => $entity,
            'dates' => $dates,
            'week'  => $week,
            'year' => $year,
            ));
    }

    /**
     * Displays a form to create a new Calendrier entity.
     *
     */
    public function newAction()
    {
        $entity = new Calendrier();
        $form   = $this->createForm(new CalendrierType(), $entity);

        return $this->render('ExploticPlanningBundle:Calendrier:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Calendrier entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Calendrier();
        $form = $this->createForm(new CalendrierType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('calendrier_show', array('id' => $entity->getId())));
        }

        return $this->render('ExploticPlanningBundle:Calendrier:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Calendrier entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Calendrier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calendrier entity.');
        }

        $editForm = $this->createForm(new CalendrierType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExploticPlanningBundle:Calendrier:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Calendrier entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:Calendrier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calendrier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CalendrierType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('calendrier_edit', array('id' => $id)));
        }

        return $this->render('ExploticPlanningBundle:Calendrier:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Calendrier entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExploticPlanningBundle:Calendrier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Calendrier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calendrier'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
