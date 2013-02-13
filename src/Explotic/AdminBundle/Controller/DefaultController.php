<?php

namespace Explotic\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ExploticAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
