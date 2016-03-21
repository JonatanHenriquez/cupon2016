<?php

    namespace AppBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\AdvancedUserInterface;


    /**
     * Usuario
     *
     * @ORM\Table(name="usuario", indexes={@ORM\Index(name="ciudad_idx", columns={"ciudad_id"}), @ORM\Index(name="rol_idx", columns={"rol"})})
     * @ORM\Entity
     */
    class Usuario implements AdvancedUserInterface , \Serializable
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
         * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
         */
        private $nombre;

        /**
         * @var string
         *
         * @ORM\Column(name="apellidos", type="string", length=255, nullable=true)
         */
        private $apellidos;

        /**
         * @var string
         *
         * @ORM\Column(name="email", type="string", length=255, nullable=true)
         */
        private $email;

        /**
         * @var string
         *
         * @ORM\Column(name="password", type="string", length=255, nullable=true)
         */
        private $password;

        /**
         * @var string
         *
         * @ORM\Column(name="direccion", type="text", length=65535, nullable=true)
         */
        private $direccion;

        /**
         * @var boolean
         *
         * @ORM\Column(name="permite_email", type="boolean", nullable=true)
         */
        private $permiteEmail;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="fecha_alta", type="datetime", nullable=true)
         */
        private $fechaAlta;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="fecha_nacimiento", type="datetime", nullable=true)
         */
        private $fechaNacimiento;

        /**
         * @var string
         *
         * @ORM\Column(name="dui", type="string", length=9, nullable=true)
         */
        private $dui;

        /**
         * @var string
         *
         * @ORM\Column(name="numero_tarjeta", type="string", length=20, nullable=true)
         */
        private $numeroTarjeta;

        /**
         * @var integer
         *
         * @ORM\Column(name="estado", type="integer", nullable=false)
         */
        private $estado;

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
         * @var \Rol
         *
         * @ORM\ManyToOne(targetEntity="Rol")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="rol", referencedColumnName="id")
         * })
         */
        private $rol;

        /**
         * @var \Doctrine\Common\Collections\Collection
         *
         * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="usuario")
         */
        private $oferta;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->oferta = new \Doctrine\Common\Collections\ArrayCollection();
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
         * @return Usuario
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
         * Set apellidos
         *
         * @param string $apellidos
         *
         * @return Usuario
         */
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;

            return $this;
        }

        /**
         * Get apellidos
         *
         * @return string
         */
        public function getApellidos()
        {
            return $this->apellidos;
        }

        /**
         * Set email
         *
         * @param string $email
         *
         * @return Usuario
         */
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get email
         *
         * @return string
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set password
         *
         * @param string $password
         *
         * @return Usuario
         */
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Get password
         *
         * @return string
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set direccion
         *
         * @param string $direccion
         *
         * @return Usuario
         */
        public function setDireccion($direccion)
        {
            $this->direccion = $direccion;

            return $this;
        }

        /**
         * Get direccion
         *
         * @return string
         */
        public function getDireccion()
        {
            return $this->direccion;
        }

        /**
         * Set permiteEmail
         *
         * @param boolean $permiteEmail
         *
         * @return Usuario
         */
        public function setPermiteEmail($permiteEmail)
        {
            $this->permiteEmail = $permiteEmail;

            return $this;
        }

        /**
         * Get permiteEmail
         *
         * @return boolean
         */
        public function getPermiteEmail()
        {
            return $this->permiteEmail;
        }

        /**
         * Set fechaAlta
         *
         * @param \DateTime $fechaAlta
         *
         * @return Usuario
         */
        public function setFechaAlta($fechaAlta)
        {
            $this->fechaAlta = $fechaAlta;

            return $this;
        }

        /**
         * Get fechaAlta
         *
         * @return \DateTime
         */
        public function getFechaAlta()
        {
            return $this->fechaAlta;
        }

        /**
         * Set fechaNacimiento
         *
         * @param \DateTime $fechaNacimiento
         *
         * @return Usuario
         */
        public function setFechaNacimiento($fechaNacimiento)
        {
            $this->fechaNacimiento = $fechaNacimiento;

            return $this;
        }

        /**
         * Get fechaNacimiento
         *
         * @return \DateTime
         */
        public function getFechaNacimiento()
        {
            return $this->fechaNacimiento;
        }

        /**
         * Set dui
         *
         * @param string $dui
         *
         * @return Usuario
         */
        public function setDui($dui)
        {
            $this->dui = $dui;

            return $this;
        }

        /**
         * Get dui
         *
         * @return string
         */
        public function getDui()
        {
            return $this->dui;
        }

        /**
         * Set numeroTarjeta
         *
         * @param string $numeroTarjeta
         *
         * @return Usuario
         */
        public function setNumeroTarjeta($numeroTarjeta)
        {
            $this->numeroTarjeta = $numeroTarjeta;

            return $this;
        }

        /**
         * Get numeroTarjeta
         *
         * @return string
         */
        public function getNumeroTarjeta()
        {
            return $this->numeroTarjeta;
        }

        /**
         * Set estado
         *
         * @param integer $estado
         *
         * @return Usuario
         */
        public function setEstado($estado)
        {
            $this->estado = $estado;

            return $this;
        }

        /**
         * Get estado
         *
         * @return integer
         */
        public function getEstado()
        {
            return $this->estado;
        }

        /**
         * Set ciudad
         *
         * @param \AppBundle\Entity\Ciudad $ciudad
         *
         * @return Usuario
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
         * Set rol
         *
         * @param \AppBundle\Entity\Rol $rol
         *
         * @return Usuario
         */
        public function setRol(\AppBundle\Entity\Rol $rol = null)
        {
            $this->rol = $rol;

            return $this;
        }

        /**
         * Get rol
         *
         * @return \AppBundle\Entity\Rol
         */
        public function getRol()
        {
            return $this->rol;
        }

        /**
         * Add ofertum
         *
         * @param \AppBundle\Entity\Oferta $ofertum
         *
         * @return Usuario
         */
        public function addOfertum(\AppBundle\Entity\Oferta $ofertum)
        {
            $this->oferta[] = $ofertum;

            return $this;
        }

        /**
         * Remove ofertum
         *
         * @param \AppBundle\Entity\Oferta $ofertum
         */
        public function removeOfertum(\AppBundle\Entity\Oferta $ofertum)
        {
            $this->oferta->removeElement($ofertum);
        }

        /**
         * Get oferta
         *
         * @return \Doctrine\Common\Collections\Collection
         */
        public function getOferta()
        {
            return $this->oferta;
        }

        /**
         * Checks whether the user's account has expired.
         *
         * Internally, if this method returns false, the authentication system
         * will throw an AccountExpiredException and prevent login.
         *
         * @return bool true if the user's account is non expired, false otherwise
         *
         * @see AccountExpiredException
         */
        public function isAccountNonExpired()
        {
            // TODO: Implement isAccountNonExpired() method.
            return true;
        }

        /**
         * Checks whether the user is locked.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a LockedException and prevent login.
         *
         * @return bool true if the user is not locked, false otherwise
         *
         * @see LockedException
         */
        public function isAccountNonLocked()
        {
            // TODO: Implement isAccountNonLocked() method.
            return !($this->getEstado() === 2);
        }

        /**
         * Checks whether the user's credentials (password) has expired.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a CredentialsExpiredException and prevent login.
         *
         * @return bool true if the user's credentials are non expired, false otherwise
         *
         * @see CredentialsExpiredException
         */
        public function isCredentialsNonExpired()
        {
            // TODO: Implement isCredentialsNonExpired() method.
            return true;
        }

        /**
         * Checks whether the user is enabled.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a DisabledException and prevent login.
         *
         * @return bool true if the user is enabled, false otherwise
         *
         * @see DisabledException
         */
        public function isEnabled()
        {
            // TODO: Implement isEnabled() method.
            return $this->getEstado() === 1;
        }


        /**
         * Returns the roles granted to the user.
         *
         * <code>
         * public function getRoles()
         * {
         *     return array('ROLE_USER');
         * }
         * </code>
         *
         * Alternatively, the roles might be stored on a ``roles`` property,
         * and populated in any number of different ways when the user object
         * is created.
         *
         * @return (Role|string)[] The user roles
         */
        public function getRoles()
        {
            // TODO: Implement getRoles() method.
            //este metodo debe a ley devolver un array
            return array($this->rol);
        }

        /**
         * Returns the salt that was originally used to encode the password.
         *
         * This can return null if the password was not encoded using a salt.
         *
         * @return string|null The salt
         */
        public function getSalt()
        {
            // TODO: Implement getSalt() method.
        }

        /**
         * Returns the username used to authenticate the user.
         *
         * @return string The username
         */
        public function getUsername()
        {
            // TODO: Implement getUsername() method.
            return $this->email;
        }

        /**
         * Removes sensitive data from the user.
         *
         * This is important if, at any given point, sensitive information like
         * the plain-text password is stored on this object.
         */
        public function eraseCredentials()
        {
            // TODO: Implement eraseCredentials() method.
        }

        /**
         * String representation of object
         * @link http://php.net/manual/en/serializable.serialize.php
         * @return string the string representation of the object or null
         * @since 5.1.0
         */
        public function serialize()
        {
            // TODO: Implement serialize() method.
            return serialize(array(
                $this->id,
            ));
        }

        /**
         * Constructs the object
         * @link http://php.net/manual/en/serializable.unserialize.php
         * @param string $serialized <p>
         * The string representation of the object.
         * </p>
         * @return void
         * @since 5.1.0
         */
        public function unserialize($serialized)
        {
            // TODO: Implement unserialize() method.
            list (
                $this->id,
                ) = unserialize($serialized);
        }
    }
