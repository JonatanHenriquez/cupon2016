<?php

    namespace AppBundle\Controller;

    use AppBundle\Entity\Usuario;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use AppBundle\Controller\Clases\Mensaje;

    class UsuarioController extends Controller
    {
        /**
         * @Route("/usuario/compras/", name="compras")
         */
        public function comprasAction()
        {
            $usuario_id = 2;

            $em = $this->getDoctrine()->getManager();

            //encontrar todas las compras hechas por un usuario logueado
            $query = "SELECT v,o,t FROM AppBundle:Venta v JOIN v.oferta o JOIN o.tienda t WHERE v.usuario = :id ORDER BY v.fecha DESC";
            $consulta = $em->createQuery($query);
            $consulta->setParameter('id' , $usuario_id);
            $compras = $consulta->getResult();

            return $this->render("AppBundle:default:comprasUsuario.html.twig" , array("compras" => $compras));
        }

        /**
         * @Route("/usuario/perfil/", name="perfilUsuario")
         */
        public function verPerfilAction(Request $request)
        {
            // Obtener los datos del usuario logueado y utilizarlos para
            // rellenar un formulario de registro.
            // Si la petición es GET, mostrar el formulario
            // Si la petición es POST, actualizar la información del usuario con
            // los nuevos datos obtenidos del formulario

            $em = $this->getDoctrine()->getManager();
            if ($request->isMethod("GET")) {

                //esto me devolvera el id del usuario logueado y es el que usare para hacer la consulta de los datos
                //asociados a este
                $usuario = $this->getUser();

                //lo anterior es la abrevacion de
                //$usuario=$this->get('security.token_storage')->getToken()->getUser();

                $user = $em->getRepository('AppBundle:Usuario')->find($usuario);
                $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();
                return $this->render('AppBundle::ActualizarDatosUsuario.html.twig' , array('usuario' => $user , 'ciudades' => $ciudades));
            } else {
                if ($request->isMethod("POST")) {

                    //obtener el usuario para solo modificarlo con getUser obtengo el id y asi puedo acceder a ese usuario
                    $userPost = $em->getRepository('AppBundle:Usuario')->find($this->getUser());

                    $userPost->setNombre($request->get('nombre'));
                    $userPost->setApellidos($request->get('apellidos'));

                    //obtengo la fecha
                    $fecha = $request->get('fecha');
                    //FUCK YEAH!!! F representa el MES
                    $date = \DateTime::createFromFormat('d F, Y' , $fecha);
                    $userPost->setFechaNacimiento($date);

                    $userPost->setDui($request->get('dui'));
                    $userPost->setDireccion($request->get('direccion'));
                    $userPost->setEmail($request->get('email'));

                    $password = $this->get('security.password_encoder')->encodePassword($userPost , $request->get('password'));
                    $userPost->setPassword($password);

                    $userPost->setNumeroTarjeta($request->get('tarjeta'));

                    //se obtiene el id de la ciudad
                    $ciudad = $em->getRepository("AppBundle:Ciudad")->find($request->get('ciudad'));
                    $userPost->setCiudad($ciudad);

                    //para determinar si quiere o no q se le envien email
                    //si en null es q no quiere por lo q agregaremos en la bd el valor de cero
                    //que sera la representacion de false,
                    //esto podia evitarlo si en la tabla ponia en permite_email el valor por default 0
                    if ($request->get("usuario_permite_email") != null) {
                        $userPost->setPermiteEmail(1);
                    } else {
                        $userPost->setPermiteEmail(0);
                    }


                    $em->persist($userPost);
                    $em->flush();

                    $this->addFlash('exito' , new Mensaje('Usuario' , 'Los datos de tu perfil se han actualizado exitosamente' , 'success'));
                    return $this->redirect($this->generateUrl('perfilUsuario'));
                }
            }//fin else POST
        }
    }
