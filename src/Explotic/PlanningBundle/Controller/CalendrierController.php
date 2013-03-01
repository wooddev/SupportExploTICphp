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
        $year = (int) $year;
        $week= (int) $week;
                        
        $agenda = new \Explotic\MainBundle\Model\Agenda();
        
        $agenda->init($week, $year);
        
        //Recherche des jours figurant dans cette partie du calendrier   
        $em = $this->getDoctrine()->getManager();
        $jours = $em->getRepository('ExploticPlanningBundle:Jour')
                        ->findByCalendrierAndDate($id,$agenda->getDateDebut(),$agenda->getDateFin());
        
        return $this->render('ExploticPlanningBundle:Calendrier:show/week.html.twig', array(
            'agenda' => $agenda->generate($jours),
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
