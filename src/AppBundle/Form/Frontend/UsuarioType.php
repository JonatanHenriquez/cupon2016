<?php
    /**
     * Created by PhpStorm.
     * User: jonat
     * Date: 26/03/2016
     * Time: 12:03
     */

    /**
     * Clase utilizada para crear el formulario de registro de acuerdo en lo que se menciona en
     * la seccion 8.7.2 Creando el formulario en su propia clase
     * se creo en el directorio Frontend ya que corresponde a usuarios no administradores por lo que no podran ver
     * el atributo fecha_alta
     */
    namespace AppBundle\Form\Frontend;

    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;

    //Clase que hara el papel de formulario pag 235 y en la doc de symfony http://symfony.com/doc/current/cookbook/doctrine/registration_form.html

    class UsuarioType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder , array $options)
        {
            //el metodo add lleva tres parametros el nombre del input, el tipo q por default es text y un array de opciones
            //estos seran los datos de la entidad que apareceran en el formulario
            $builder
                ->add('nombre')
                ->add('apellidos')

                //especifica que se require un dato de tipo email
                ->add('email', EmailType::class )

                //para que solicite dos veces la contraseña
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Las dos contraseñas deben de coincidir',
                    'required' => true,
                    'first_options' => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repita Contraseña')

                ))

                ->add('direccion')

                //es falso ya que no obliga al usuario aceptar boletines de noticias
                ->add('permite_email', CheckboxType::class, array('required' => false))

                //fecha de nacimiento
                ->add('fecha_nacimiento', DateType::class, array(
                    'widget' => 'single_text',
                    //hice que el formato coincidiera con el formato que maneja las fechas materialize
                    'format' => 'd MMMM, yyyy'
                ))

                ->add('dui')
                ->add('numeroTarjeta')
                ->add('ciudad', EntityType::class, array(
                    'class'         => 'AppBundle\Entity\Ciudad',
                    'empty_data'   => 'Selecciona una ciudad',
                ))
            ;
        }

        public function setDefaultOptions(OptionsResolver $resolver)
        {
            //se indica el namespace de la entidad cuyos datos modifican al formulario
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Usuario'
            ));

        }

        //define un nombre único para el formulario con el método getName(). Este nombre
        //normalmente sigue la nomenclatura {nombre-proyecto}_{nombre-bundle}_{nombre-clase}.
        public function getName()
        {
            return 'cupon_appbundle_usuariotype';

        }


    }