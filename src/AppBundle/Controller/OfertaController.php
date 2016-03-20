<?php

    namespace AppBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class OfertaController extends Controller
    {
        /**
         * @Route("/{ciudad}/ofertas/{ficha}/" , name="detalles_oferta")
         */
        public function detallesOfertaAction($ciudad , $ficha)
        {
            $em = $this->getDoctrine()->getEntityManager();

            //aqui en la ruta ficha corresponde a la de la oferta
            $city = $em->getRepository("AppBundle:Ciudad")->findOneBy(array('ficha' => $ciudad));
            $oferta = $em->getRepository("AppBundle:Oferta")->findOneBy(array("ciudad" => $city , "revisada" => '1' , "ficha" => $ficha));

            /*
            * supongo que lo anterior seria igual a esto
            * $consulta = $em->createQuery('
            * SELECT o, c, t FROM OfertaBundle:Oferta o
            * JOIN o.ciudad c JOIN o.tienda t
            * WHERE o.revisada = true
            * AND o.slug = :slug
            * AND c.slug = :ciudad');
            */

            //me permite obtener las 5 ofertas relacionadas a una ciudad

            //con esta join obtengo todos los objetos oferta y ciudad a la vez
            $consulta = $em->createQuery(' SELECT o, c FROM AppBundle:Oferta o JOIN o.ciudad c WHERE o.revisada = 1 AND o.fechaPublicacion <= :fecha AND c.ficha != :ciudad ORDER BY o.fechaPublicacion DESC');
            $consulta->setMaxResults(5);
            $consulta->setParameter('ciudad' , $ciudad);
            $consulta->setParameter('fecha' , new \DateTime('today'));
            $relacionadas = $consulta->getArrayResult();

            if (!$oferta || !$relacionadas) {
                throw  $this->createNotFoundException('No se ha encontrado la oferta');
            }
            return $this->render("AppBundle:default:detalle.html.twig" , array('oferta' => $oferta , 'relacionadas' => $relacionadas));
            //return $this->render("AppBundle:default:detalle.html.twig" , array('oferta' => $oferta));

        }


    }
