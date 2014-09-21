<?php

namespace Ventas\ProveedorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ventas\ProveedorBundle\Entity\Proveedor;
use Ventas\ProductoBundle\Entity\Producto;
use Ventas\ProveedorBundle\Form\ProveedorType;
use Ventas\ProductoBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\Request;

class ProveedorController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proveedores = $em->getRepository('ProveedorBundle:Proveedor')->findAll();

        return $this->render('ProveedorBundle:Proveedor:index.html.twig', 
            array('proveedores' => $proveedores)
        );
    }

    public function newAction(Request $request)
    {
        $proveedor = new Producto();
        $formulario = $this->createForm(new ProductoType(), $proveedor);

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();
 
            $this->get('session')->getFlashBag()->add('info',
                'Los datos del proveedor se han creado.'
            );
 
            return $this->redirect(
                $this->generateUrl('proveedor_list')
            );
        }
 
        return $this->render('ProveedorBundle:Proveedor:new.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $proveedor = $em->getRepository('ProveedorBundle:Proveedor')->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('No se ha encontrado el proveedor solicitado');
        }

        return $this->render('ProveedorBundle:Proveedor:show.html.twig', 
            array('proveedor' => $proveedor)
        );
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $proveedor = $em->getRepository('ProveedorBundle:Proveedor')->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('No se ha encontrado el proveedor solicitado');
        }

        $formulario = $this->createForm(new ProveedorType(), $proveedor);

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();
 
            $this->get('session')->getFlashBag()->add('info',
                'Los datos del proveedor se han guardado.'
            );
 
            return $this->redirect(
                $this->generateUrl('proveedor_list')
            );
        }

        return $this->render('ProveedorBundle:Proveedor:edit.html.twig', array(
            'formulario' => $formulario->createView(),
            'proveedor' => $proveedor
        ));
    }

    public function deleteAction($id)
    {
        if (empty($id))
            return $this->redirect( $this->generateUrl('proveedor_list') );

        $em = $this->getDoctrine()->getManager();

        $proveedor = $em->getRepository('ProveedorBundle:Proveedor')->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('No se ha encontrado el proveedor solicitado');
        }

        $em->remove($proveedor);
        $em->flush();

        $this->get('session')->getFlashBag()->add('info',
            'Se ha eliminado el proveedor.'
        );

        return $this->redirect($this->generateUrl('proveedor_list'));
    }
}
