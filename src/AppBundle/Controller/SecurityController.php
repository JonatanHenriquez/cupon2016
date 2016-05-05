<?php

    namespace AppBundle\Controller;

    use AppBundle\Controller\Clases\Mensaje;
    use AppBundle\Entity\Rol;
    use AppBundle\Entity\Usuario;
    use AppBundle\Form\Frontend\UsuarioType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
    use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
    use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;


    class SecurityController extends Controller
    {
        /**
         * @Route("/usuario/login", name="login")
         */
        public function loginAction(Request $request)
        {
            $error_ = null;
            if ($this->get("session")->has("_security_default"))
                return $this->redirectToRoute("homepage");

            $authenticationUtils = $this->get('security.authentication_utils');

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            if ($error) {
                if ($error->getMessageKey() == "Account is disabled.")
                    $error_ = "Usuario deshabilitado.";
                if ($error->getMessageKey() == "Account is locked.")
                    $error_ = "Usuario bloqueado.";
                if ($error->getMessageKey() == "Invalid credentials.")
                    $error_ = "Credenciales incorrectas.";
            }

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render(
                'AppBundle:security:login.html.twig' ,
                array(
                    // last username entered by the user
                    'last_username' => $lastUsername ,
                    'error' => $error_ ,
                )
            );
        }


        public function cajaLoginAction()
        {
            $error_ = null;
            if ($this->get("session")->has("_security_default"))
                return $this->redirectToRoute("homepage");

            $authenticationUtils = $this->get('security.authentication_utils');

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            if ($error) {
                if ($error->getMessageKey() == "Account is disabled.")
                    $error_ = "Usuario deshabilitado.";
                if ($error->getMessageKey() == "Account is locked.")
                    $error_ = "Usuario bloqueado.";
                if ($error->getMessageKey() == "Invalid credentials.")
                    $error_ = "Credenciales incorrectas.";
            }

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render(
                'AppBundle:security:cajaLogin.html.twig' ,
                array(
                    // last username entered by the user
                    'last_username' => $lastUsername ,
                    'error' => $error_ ,
                )
            );
        }

        /**
         * @Route("/usuario/registro/", name="registro")
         */
        public function registroAction(Request $request)
        {
            // 1) construir el formulario
            $usuario = new Usuario();
            $formulario = $this->createForm(UsuarioType::class , $usuario);

            //2) Manejar el submit solo con post sucede esto
            $formulario->handleRequest($request);
            if ($formulario->isSubmitted() && $formulario->isValid()) {
                //3) Encodear el password
                $password = $this->get('security.password_encoder')->encodePassword($usuario , $usuario->getPassword());
                $usuario->setPassword($password);


                $em = $this->getDoctrine()->getManager();
                //obtengo el rol de tipo usuario
                $rol = $em->getRepository("AppBundle:Rol")->find(1);
                $usuario->setRol($rol);
                $usuario->setEstado(1);


                //4) guardar el usuario
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();

                //5) añadir un mensaje flash, estos se muestran luego q es redireccionado el usuario
                $this->addFlash('exito' , new Mensaje('Usuario' , '¡Enhorabuena,' . $usuario->getNombre() . '! Te has registrado con exito' , 'success'));


                //6) codigo para autologuear al usuario una vez registrado en la pagina
                //$token = new UsernamePasswordToken($usuario, $usuario->getPassword() , 'users_db' , $usuario->getRoles());
                //$this->get('security.token_storage')->setToken($token);

                //7) redirige a la pagina con la portada de la ciudad a la que pertenece
                return $this->redirectToRoute('portadaCiudad' , array(
                    'ciudad' => $usuario->getCiudad()->getFicha()
                ));
            }


            // 2) manejar el sumbit solo con post sucede esto
            return $this->render(
                "AppBundle:security:registro.html.twig" ,
                array('formulario' => $formulario->createView()));

        }

        /**
         * @Route("/usuario/registro2/", name="registro2").
         */
        public function registroUsuarioAction(Request $request)
        {
            //Si la solicitud es post, es decir se envia el formulario de registro
            if ($request->isMethod('POST')) {
                $em = $this->getDoctrine()->getManager();

                $usuario = new Usuario();

                $usuario->setNombre($request->get('nombre'));
                $usuario->setApellidos($request->get('apellidos'));

                //obtengo la fecha
                $fecha = $request->get('fecha');
                //FUCK YEAH!!!
                $date = \DateTime::createFromFormat('d F, Y' , $fecha);
                $usuario->setFechaNacimiento($date);

                $usuario->setDui($request->get('dui'));
                $usuario->setDireccion($request->get('direccion'));
                $usuario->setEmail($request->get('email'));

                $password = $this->get('security.password_encoder')->encodePassword($usuario , $request->get('password'));
                $usuario->setPassword($password);

                $usuario->setNumeroTarjeta($request->get('tarjeta'));

                //se obtiene el id de la ciudad
                $ciudad = $em->getRepository("AppBundle:Ciudad")->find($request->get('ciudad'));
                $usuario->setCiudad($ciudad);

                //obtengo el rol de tipo usuario, q en este caso lo doy por fijo q sera un cliente normal
                $rol = $em->getRepository("AppBundle:Rol")->find(1);
                $usuario->setRol($rol);
                $usuario->setEstado(1);

                //para determinar si quiere o no q se le envien email
                //si en null es q no quiere por lo q agregaremos en la bd el valor de cero
                //que sera la representacion de false,
                //esto podia evitarlo si en la tabla ponia en permite_email el valor por default 0
                if ($request->get("usuario_permite_email") != null) {
                    $usuario->setPermiteEmail(1);
                } else {
                    $usuario->setPermiteEmail(0);
                }

                //4) guardar el usuario
                $em->persist($usuario);
                $em->flush();

                //5) añadir un mensaje flash, estos se muestran luego q es redireccionado el usuario
                $this->addFlash('exito' , new Mensaje('Usuario' , '¡Enhorabuena, ' . $usuario->getNombre() . ' ! Te has registrado con exito' , 'success'));

                //6) codigo para autologuear al usuario una vez registrado en la pagina
               // $token = new UsernamePasswordToken($usuario->getUsername() , $usuario->getPassword() , 'users_db' , $usuario->getRoles());
                //$this->get('security.token_storage')->setToken($token);

                //redirige a la portada de la ciudad del usuario, esto se logra con los listenerAction
                // ---- ver LoginListener
                return $this->redirectToRoute('portadaCiudad' , array('ciudad' => $usuario->getCiudad()->getFicha()));

            }

            //obtengo las ciudades
            $em = $this->getDoctrine()->getManager();
            $ciudades = $em->getRepository("AppBundle:Ciudad")->findAll();

            //7) redirige a la pagina de registro ya con las ciudades agregadas en el twig
            return $this->render("AppBundle:security:registro2.html.twig" , array('ciudades' => $ciudades));

        }
    }
