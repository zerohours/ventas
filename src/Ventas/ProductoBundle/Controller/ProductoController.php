<?php

namespace Ventas\ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductoController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductoBundle:Producto:index.html.twig');
    }
}
