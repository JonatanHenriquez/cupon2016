<?php

    namespace AppBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Validator\Constraints\DateTime;

    class DefaultController extends Controller
    {

        //Ruta para la portada para ciudad por defecto
        /**
         * @Route("/", name="homepage")
         */
        public function portadaAction()
        {

            //Me mostrara la oferta del dia en caso de que sea un usuario normal la de la ciudad por defecto en caso
            //de que sea uno loguedo se mostrara la de su ciudad, segun la fecha actual
            $em = $this->getDoctrine()->getManager();

            //en este caso se tomara como la ciudad por defecto la que posea id 1 que esta en el config.yml
           $oferta = $em -> getRepository("AppBundle:Oferta")->findOneBy(array("fechaPublicacion" => new \DateTime('2016-02-21'), "ciudad" => $this->container->getParameter('cupon.ciudad_por_defecto'), 'revisada' => 1));

            /*lo anterior se pueden hacer consultas usando DQL que trabaja a base de objetos no como sql a base de tablas, por ejemplo:*/
            /*$consulta = $em->createQuery('SELECT o FROM AppBundle:Oferta o WHERE o.ciudad = :ciudad AND o.fechaPublicacion = :fecha');
            $consulta->setParameter('ciudad',1);
            $consulta->setParameter('fecha','2016-02-19');
            $oferta = $consulta->getSingleResult();*/

            /*otra consulta DQL

            $consulta = $em -> createQuery('SELECT o FROM AppBundle:Oferta o WHERE o.precio < :precio ORDER BY o.nombre ASC ' );
            $consulta->setParameter('precio',20);
            $ofertas = $consulta->getResult();
            */

            /* mensaje de error
            if (!$oferta) {
                throw  $this->createNotFoundException('No se ha encontrado la oferta del dia en la ciudad seleccionada');
            }
            */
            return $this->render("AppBundle:default:portada.html.twig" , array('oferta' => $oferta));

        }

        //Ruta para la portada de una deteminada ciudad
        /**
         * @Route("/{ciudad}/", name="portadaCiudad")
         */
        public function portadaCiudadAction($ciudad = null)
        {
            //es el objeto que me permite acceder a la base de datos
            $em = $this->getDoctrine()->getManager();

            //findAll me da todos los registros de la tabla
            //findBy me permite hacer consultas mas complejas y me da muchos resultados
            //findOneBy me da un unico resultado

            //me encuentra aquella oferta segun el id
            //$oferta = $em->getRepository("AppBundle:Oferta")->findBy(array('fechaPublicacion' => new \DateTime('2016-02-19'), 'ciudad' => $ciudad));

            //me encuentra aquella oferta segun el id
            $ciudadBuscada = $em->getRepository("AppBundle:Ciudad")->findOneBy(array('ficha' => $ciudad));
            //aqui cambiar el dateTime por today
            $oferta = $em->getRepository("AppBundle:Oferta")->findOneBy(array('fechaPublicacion' => new \DateTime('2016-02-19'), 'ciudad' => $ciudadBuscada, 'revisada' => 1));


            /*
            //$oferta ya contiene toda la informacion de la oferta por lo que ya puedo acceder asi
            $precio = $oferta->getPrecio();
            $ofertaRevisada = $em->getRepository("AppBundle:Oferta")->findBy(array('revisada' => 1));

            //encontrar la ciudad Vitoria-gateiz
            $ciudad = $em->getRepository("AppBundle:Ciudad")->findOneBy(array('ficha' => 'vitoria-gasteiz'));

            //encontrar los usuarios de vitoria-gateiz que permitan envio de email
            $usuarios = $em->getRepository("AppBundle:Usuario")->findBy(array('ciudad' => $ciudad->getId() , 'permiteEmail' => true));
*/

            return $this->render("AppBundle:default:portada.html.twig", array('oferta' => $oferta));

        }


    }
