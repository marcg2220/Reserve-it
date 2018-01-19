<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 18/01/2018
 * Time: 14:00
 */

namespace AppBundle\Form;


use AppBundle\Form\Listener\AddPistaFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventSubscriber(new AddPistaFieldSubscriber());

        // recordar importar las clases FormEvents y FormEvent
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $reserva = $event->getData();
            $form = $event->getForm();

            if($reserva and $reserva->getPista()){
                // obtenemos el country por medio del objeto state:
                $tipus_pista = $reserva->getPista()->getTipusPista();
            }else{
                $tipus_pista = null;
            }

            $form->add('tipus_pista', 'entity', array(
                'class' => 'AppBundle\Entity\TipusPista',
                'mapped' => false, // importante indicar que el campo no está mapeado
                'data' => $tipus_pista, //establecemos el valor inicial del campo.
            ));
        });

    }

    public function AddPistaFieldSubscriber(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reserva',
        ));
    }

    public function getName()
    {
        return 'reserva';
    }

    /*$builder
                ->add('tipus_pista', 'entity', array(
                    'class' => 'AppBundle:TipusPista',
                    'property' => 'descripcio',
                ))

                ->add('pista', 'entity', array(
                    'class' => 'AppBundle:Pista',
                ));


            // Afegim un EventListener que actualitzarà el camp Pista
            // per tal que les seves opcions corresponguin
            // amb el tipus de pista seleccionat per l'usuari
            $builder->addEventSubscriber(new AddPistaFieldSubscriber());*/




}