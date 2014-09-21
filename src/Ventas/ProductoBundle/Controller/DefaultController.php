<?php

namespace Ventas\ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProductoBundle:Default:index.html.twig', array('name' => $name));
    }
}
