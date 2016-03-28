<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oferta
 *
 * @ORM\Table(name="oferta", indexes={@ORM\Index(name="tienda_idx", columns={"tienda_id"}), @ORM\Index(name="ciudad_idx", columns={"ciudad_id"})})
 * @ORM\Entity
 */
class Oferta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ficha", type="string", length=255, nullable=true)
     */
    private $ficha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="condiciones", type="string", length=255, nullable=true)
     */
    private $condiciones;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="descuento", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $descuento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_publicacion", type="datetime", nullable=true)
     */
    private $fechaPublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime", nullable=true)
     */
    private $fechaExpiracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="compras", type="integer", nullable=true)
     */
    private $compras;

    /**
     * @var integer
     *
     * @ORM\Column(name="umbral", type="integer", nullable=true)
     */
    private $umbral;

    /**
     * @var integer
     *
     * @ORM\Column(name="revisada", type="integer", nullable=true)
     */
    private $revisada;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var \Tienda
     *
     * @ORM\ManyToOne(targetEntity="Tienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tienda_id", referencedColumnName="id")
     * })
     */
    private $tienda;

    /**
     * @var \Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     * })
     */
    private $ciudad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="oferta")
     * @ORM\JoinTable(name="venta",
     *   joinColumns={
     *     @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   }
     * )
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Oferta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ficha
     *
     * @param string $ficha
     *
     * @return Oferta
     */
    public function setFicha($ficha)
    {
        $this->ficha = $ficha;

        return $this;
    }

    /**
     * Get ficha
     *
     * @return string
     */
    public function getFicha()
    {
        return $this->ficha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set condiciones
     *
     * @param string $condiciones
     *
     * @return Oferta
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }

    /**
     * Get condiciones
     *
     * @return string
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Oferta
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     *
     * @return Oferta
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Oferta
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     *
     * @return Oferta
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return \DateTime
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set compras
     *
     * @param integer $compras
     *
     * @return Oferta
     */
    public function setCompras($compras)
    {
        $this->compras = $compras;

        return $this;
    }

    /**
     * Get compras
     *
     * @return integer
     */
    public function getCompras()
    {
        return $this->compras;
    }

    /**
     * Set umbral
     *
     * @param integer $umbral
     *
     * @return Oferta
     */
    public function setUmbral($umbral)
    {
        $this->umbral = $umbral;

        return $this;
    }

    /**
     * Get umbral
     *
     * @return integer
     */
    public function getUmbral()
    {
        return $this->umbral;
    }

    /**
     * Set revisada
     *
     * @param integer $revisada
     *
     * @return Oferta
     */
    public function setRevisada($revisada)
    {
        $this->revisada = $revisada;

        return $this;
    }

    /**
     * Get revisada
     *
     * @return integer
     */
    public function getRevisada()
    {
        return $this->revisada;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Oferta
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set tienda
     *
     * @param \AppBundle\Entity\Tienda $tienda
     *
     * @return Oferta
     */
    public function setTienda(\AppBundle\Entity\Tienda $tienda = null)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get tienda
     *
     * @return \AppBundle\Entity\Tienda
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set ciudad
     *
     * @param \AppBundle\Entity\Ciudad $ciudad
     *
     * @return Oferta
     */
    public function setCiudad(\AppBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \AppBundle\Entity\Ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Oferta
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNombre();
    }
}
