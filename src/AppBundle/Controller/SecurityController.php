<?php

    namespace AppBundle\Controller;

    use AppBundle\Controller\Clases\Mensaje;
    use AppBundle\Entity\Rol;
    use AppBundle\Entity\Usuario;
    use AppBundle\Form\Frontend\UsuarioType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;



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
            if ($formulario->isSubmitted() && $formulario->isValid() ) {
                echo ':)';
                //3) Encodear el password
                $password = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPassword());
                $usuario->setPassword($password);

                $usuario->setFechaNacimiento(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                //obtengo el rol de tipo usuario
                $rol = $em->getRepository("AppBundle:Rol")->find(1);
                $usuario->setRol($rol);
                $usuario->setEstado(1);


                //4) guardar el usuario
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();

                //añadir un mensaje flash
                $this->addFlash('noticia',new Mensaje('Usuario','¡Enhorabuena! Te has registrado con exito','sucess'));


                return $this->redirectToRoute('portadaCiudad',array('ciudad'=>$usuario->getCiudad()->getFicha()));
                }



            // 2) manejar el sumbit solo con post sucede esto
            return $this->render(
                "AppBundle:security:registro.html.twig" ,
                array('formulario' => $formulario->createView()));

        }

    }
