<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario/compras/", name="compras")
     */
    public function comprasAction(){
        $usuario_id = 2;

        $em=$this->getDoctrine()->getManager();

        //encontrar todas las compras hechas por un usuario logueado
        $query = "SELECT v,o,t FROM AppBundle:Venta v JOIN v.oferta o JOIN o.tienda t WHERE v.usuario = :id ORDER BY v.fecha DESC";
        $consulta = $em->createQuery($query);
        $consulta->setParameter('id',$usuario_id);
        $compras = $consulta->getResult();

        return $this->render("AppBundle:default:comprasUsuario.html.twig", array("compras" => $compras));
    }
}
