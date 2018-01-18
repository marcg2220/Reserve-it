<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 16/01/2018
 * Time: 13:37
 */

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('cognoms')
            ->add('email', 'email')
            ->add('passwordEnClar', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les contrasenyes han de coincidir',
                'first_options' => array('label' => 'Contrasenya'),
                'second_options' => array('label' => 'Repeteix la contrasenya'),
                'required' => false,
            ))
            ->add('dni')
            ->add('accepta_email', 'checkbox', array('required' => false))
            ->add('data_naixement', 'birthday');
            if('crear_usuari' === $options['accio'])
            {
                $builder->add('registrar', 'submit', array(
                    'label' => 'Registrar-me',
                    'attr' => array('class' => 'boton'),
                ));
            }
            elseif ('modificar_perfil' ===$options['accio'])
            {
                $builder->add('guardar', 'submit', array(
                    'label' => 'Guardar els canvis',
                    'attr' => array('class' => 'boton'),
                ));
            }
    }

    public function configureOptions(OptionsResolver $resolve)
    {
        $resolve->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuari',
            'accio' => 'modificar_perfil',
            'validation_groups' => array('default'),
        ));
    }
    public function getBlockPrefix()
    {
        return 'usuari';
    }

}