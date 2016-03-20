<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CiudadController extends Controller
{

    /**
     * @Route("/ciudad/cambiar-a-{ciudad}/", name = "cambiar-a")
     */
    public function cambiarCiudadAction($ciudad)
    {
        return new RedirectResponse(
            $this->generateUrl('portadaCiudad',array('ciudad'=>$ciudad))
        );

        //o bien
        //return $this->redirectToRoute('portadaCiudad' , array('ciudad' => $ciudad));

    }

    /*
     * cuando en el render se envia un parametro con with
        public function listaCiudadesAction($ciudad){

            //$la variable ciudad es la que se recibe del twig base llamada ciudadSeleccionada
            $em = $this->getDoctrine()->getEntityManager();

            //obtengo todas las ciudades y las renderizo en un select
            $ciudades = $em->getRepository("AppBundle:Ciudad")->findAll();
            return $this->render('AppBundle:default:listaCiudades.html.twig',array('ciudadActual' => $ciudad , 'ciudades' => $ciudades));
        }*/


    public function listaCiudadesAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        //obtengo todas las ciudades y las renderizo en un select
        $ciudades = $em->getRepository("AppBundle:Ciudad")->findAll();
        return $this->render('AppBundle:default:listaCiudades.html.twig' , array('ciudades' => $ciudades));

    }

    /**
     * @Route("/{ciudad}/recientes", name="recientes")
     */
    public function recientesAction($ciudad){

        $em = $this->getDoctrine()->getEntityManager();

        //obtengo las ofertas mas recientes de esa ciudad
        $query = "SELECT o,c,t FROM AppBundle:Oferta o JOIN o.ciudad c JOIN o.tienda t WHERE o.fechaPublicacion <= :fecha AND c.ficha = :ciudad AND o.revisada = 1 ORDER BY o.fechaPublicacion ASC";
        $consulta = $em->createQuery($query);
        $consulta->setMaxResults(5);
        $consulta->setParameter("fecha",new \DateTime('today'));
        $consulta->setParameter("ciudad",$ciudad);
        $ofertas = $consulta->getResult();

        //obtengo los datos de la ciudad
        $city = $em->getRepository("AppBundle:Ciudad")->findOneBy(array("ficha"=>$ciudad));

        //encontrar las ciudades mas cercanas
        $consulta2 = $em->createQuery("SELECT c FROM AppBundle:Ciudad c WHERE c.ficha != :ciudad");
        $consulta2->setMaxResults(5);
        $consulta2->setParameter("ciudad",$ciudad);
        $cercanas = $consulta2->getResult();

        return $this->render("AppBundle:default:recientes.html.twig",array("ofertas" => $ofertas, "cercanas"=>$cercanas,"ciudad"=>$city));


    }
}
