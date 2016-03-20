<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TiendaController extends Controller
{
    /**
     * @Route("/{ciudad}/tiendas/{tienda}" , name="tienda_portada")
     */
    public function tiendaPortadaAction($ciudad,$tienda){
        $em = $this->getDoctrine()->getEntityManager();

        //se obtiene la ciudad q se desea buscar una tienda
        $city = $em->getRepository("AppBundle:Ciudad")->findOneBy(array('ficha'=>$ciudad));

        if(!$ciudad){
            $this->createNotFoundException("No existe la ciudad llamada ".$ciudad);
        }

        //se obtiene la tienda de esa ciudad de acuerdo a su ficha
        $store = $em->getRepository("AppBundle:Tienda")->findOneBy(array('ficha'=>$tienda, 'ciudad'=>$city->getId()));

        if(!$store){
            throw  $this->createNotFoundException("No existe esta tienda: ".$tienda);
        }

        //obtengo las ofertas publicadas por la tienda
        $consultaOfertas = $em->createQuery("SELECT o FROM AppBundle:Oferta o WHERE o.fechaPublicacion < :fecha AND o.revisada = 1 AND o.tienda = :id ORDER BY o.fechaExpiracion DESC");
        $consultaOfertas->setMaxResults(10);
        $consultaOfertas->setParameter("fecha",new \DateTime('now'));
        $consultaOfertas->setParameter("id",$store->getId());
        $ofertas = $consultaOfertas->getResult();

        //obtener las tiendas de esa ciudad
        $consultaTiendas = $em->createQuery("SELECT t,c FROM AppBundle:Tienda t JOIN t.ciudad c WHERE t.ficha != :store AND c.ficha = :ciudad");
        $consultaTiendas->setMaxResults(5);
        $consultaTiendas->setParameter("store",$store->getFicha());
        //obtengo la ciudad asociada a la tienda
        $consultaTiendas->setParameter("ciudad",$store->getCiudad()->getFicha());
        $cercanas = $consultaTiendas->getResult();

        return $this->render("AppBundle:default:portadaTienda.html.twig", array("ofertas" => $ofertas, "cercanas" => $cercanas, "tienda" => $store));
    }
}
