<?php

namespace Ventas\ProveedorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProveedorBundle:Default:index.html.twig', array('name' => $name));
    }
}
