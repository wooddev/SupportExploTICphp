<?php

namespace Explotic\FormationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ExploticFormationBundle:Default:index.html.twig', array('name' => $name));
    }
}
