<?php

namespace Explotic\PlanningBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Explotic\PlanningBundle\Entity\MyBooking;

/**
 * MyBooking controller.
 *
 * @Route("/mybooking")
 */
class MyBookingController extends Controller
{

    /**
     * Lists all MyBooking entities.
     *
     * @Route("/", name="mybooking")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ExploticPlanningBundle:MyBooking')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a MyBooking entity.
     *
     * @Route("/{id}", name="mybooking_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExploticPlanningBundle:MyBooking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MyBooking entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
