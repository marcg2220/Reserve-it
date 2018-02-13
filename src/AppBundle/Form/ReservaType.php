<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 18/01/2018
 * Time: 14:00
 */

namespace AppBundle\Form;


use AppBundle\Form\Listener\AddPistaFieldSubscriber;
//use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

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

            $form->add('pista', 'entity', array(
                'class' => 'AppBundle\Entity\Pista',
                'mapped' => false, // importante indicar que el campo no está mapeado
                'data' => "", //establecemos el valor inicial del campo.
            ));

            $form->add('diaReserva', 'date', array(
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'data' => new \DateTime(),
                'attr' => ['class' => 'js-datepicker'],
            ));

        });

        $builder->addEventSubscriber(new AddPistaFieldSubscriber());

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

}