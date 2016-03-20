<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SitioController extends Controller
{

    /**
     * @Route("/sitio/{pagina_estatica}/", name="pagina_estatica")
     *
     */
    public function paginaEstaticaAction($pagina_estatica)
    {
        return $this->render("AppBundle:sitio:".$pagina_estatica.".html.twig");
    }

}
