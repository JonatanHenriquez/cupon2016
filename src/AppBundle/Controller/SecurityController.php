<?php

    namespace AppBundle\Controller;

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
            if($this->get("session")->has("_security_default"))
                return $this->redirectToRoute("homepage");

            $authenticationUtils = $this->get('security.authentication_utils');

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            if($error)
            {
                if($error->getMessageKey() == "Account is disabled." )
                    $error_ = "Usuario deshabilitado.";
                if($error->getMessageKey() == "Account is locked." )
                    $error_ = "Usuario bloqueado.";
                if($error->getMessageKey() == "Invalid credentials." )
                    $error_ = "Credenciales incorrectas.";
            }

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render(
                'AppBundle:security:login.html.twig',
                array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error_,
                )
            );
        }

    }
