<?php

namespace Explotic\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExploticMainBundle:Default:index.html.twig');
    }
}
