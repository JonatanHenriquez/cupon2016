<?php
    /**
     * Created by PhpStorm.
     * User: jonat
     * Date: 20/03/2016
     * Time: 4:12
     */

    namespace AppBundle\Listener;

    use Symfony\Component\Routing\Router;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
    use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


    class LoginListener
    {
        private $router, $ciudad = null;

        //Para que el listener sea capaz de acceder a las rutas
        public function __construct(Router $router)
        {
            $this->router = $router;
        }

        //obtiene el token del logueado y asi la entidad Usuario y su ciudad
        public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
        {
            /**
             * Para almacenar la fecha y la hora en que se conecta un usuario podemos usar este
             * codigo, siempre y cuando usuario tenga un atributo de fecha para la ultima conexion:
             *
             * $usuario = $event->getAuthenticationToken()->getUser();
             * $usuario->setUltimaConexion(new \DateTime());
             */

            //el ultimo usuario logueada
            $token = $event->getAuthenticationToken();
            $this->ciudad = $token->getUser()->getCiudad()->getFicha();
        }

        //esta es la porcion de codigo que me permitira redireccionar
        public function onKernelResponse(FilterResponseEvent $event){
            if(null != $this->ciudad){
                $portada = $this->router->generate('portadaCiudad', array('ciudad' => $this->ciudad));
                $event->setResponse(new RedirectResponse($portada));

            }
        }

    }