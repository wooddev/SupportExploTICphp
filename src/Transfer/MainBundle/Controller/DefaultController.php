<?php

namespace Transfer\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TransferMainBundle:Default:index.html.twig');
    }           
    
}
