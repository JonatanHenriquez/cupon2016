<?php

    namespace AppBundle\Entity;

    use AppBundle\AppBundle;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Venta
     *
     * @ORM\Table(name="venta", indexes={@ORM\Index(name="oferta_idx", columns={"oferta_id"}), @ORM\Index(name="usuario_idx", columns={"usuario_id"})})
     * @ORM\Entity
     */
    class Venta
    { //Esta entidad es una relacion de many to one unidireccional a usuario y oferta
        /**
         * @var \Oferta
         *
         * @ORM\Id
         *
         * @ORM\ManyToOne(targetEntity="Oferta")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
         * })
         */
        private $oferta;

        /**
         * @var \Usuario
         *
         * @ORM\Id
         *
         * @ORM\ManyToOne(targetEntity="Usuario")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
         * })
         */
        private $usuario;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="fecha", type="datetime", nullable=true)
         */
        private $fecha;



        /**
         * Set oferta
         *
         * @param \AppBundle\Entity\Oferta $oferta
         *
         * @return Venta
         */
        public function setOferta(\AppBundle\Entity\Oferta $oferta = null)
        {
            $this->oferta = $oferta;

            return $this;
        }

        /**
         * Get oferta
         *
         * @return \AppBundle\Entity\Oferta
         */
        public function getOferta()
        {
            return $this->oferta;
        }

        /**
         * Set usuario
         *
         * @param \AppBundle\Entity\Usuario
         *
         * @return Venta
         */
        public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
        {
            $this->usuario = $usuario;

            return $this;
        }

        /**
         * Get usuarioId
         *
         * @return \AppBundle\Entity\Usuario
         */
        public function getUsuario()
        {
            return $this->usuario;
        }

        /**
         * Set fecha
         *
         * @param \DateTime $fecha
         *
         * @return Venta
         */
        public function setFecha($fecha)
        {
            $this->fecha = $fecha;

            return $this;
        }

        /**
         * Get fecha
         *
         * @return \DateTime
         */
        public function getFecha()
        {
            return $this->fecha;
        }
    }
