<?php
/**
 * Created by PhpStorm.
 * User: Joham Vanwilliam
 * Date: 07/08/2015
 * Time: 22:28
 */

namespace AppBundle\Controller\Clases;

/**
 * Class Mensaje
 * @package AppBundle\Clases
 */
class Mensaje
{

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $titulo = "Mensaje";

    /**
     * @var string
     */
    private $contenido;

    /**
     * @var boolean
     */
    private $sombra = true;

    /**
     * @var string
     */
    private $posicion = "bottom";

    /**
     * Mensaje constructor.
     * @param string $titulo
     * @param string $contenido
     * @param string $tipo
     */
    public function __construct($titulo, $contenido, $tipo)
    {
        $this->contenido = $contenido;
        $this->titulo = $titulo;
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return Mensaje
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     * @return Mensaje
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @param string $contenido
     * @return Mensaje
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSombra()
    {
        return $this->sombra;
    }

    /**
     * @param boolean $sombra
     * @return Mensaje
     */
    public function setSombra($sombra)
    {
        $this->sombra = $sombra;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * @param string $posicion
     * @return Mensaje
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;

        return $this;
    }

    public function toArray()
    {
        $arr = new \stdClass();
        $arr->titulo = $this->titulo;
        $arr->contenido = $this->contenido;
        $arr->tipo = $this->tipo;

        return $arr;
    }

}