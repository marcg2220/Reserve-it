<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 18/01/2018
 * Time: 18:52
 */

namespace AppBundle\Form\Listener;


use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddPistaFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        //FormEvents::PRE_SET_DATA => 'preSetData'
        //FormEvents::PRE_SUBMIT => 'preSubmit'
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $this->addField($event->getForm(), $data["tipus_pista"]);
    }

    protected function addField(Form $form, $tipus_pista)
    {
        $form->add('pista', 'entity', array(
            'class' => 'AppBundle\Entity\Pista',
            'query_builder' => function(EntityRepository $er) use ($tipus_pista){
                return $er->createQueryBuilder('pista')
                    ->where('pista.tipus_pista = :tipus_pista')
                    ->setParameter('tipus_pista', $tipus_pista);
            }
        ));
    }

    public function preSetData(FormEvent $event)
    {
        $reserva = $event->getData();
        $form = $event->getForm();

        if($reserva and $reserva->getPista()){
            // obtenemos el country por medio del objeto state:
            $tipus_pista = $reserva->getPista()->getTipusPista();
        }else{
            $tipus_pista = null;
        }

        echo "tipus pista -> " . $reserva;

        $form->add('pista', 'entity', array(
            'class' => 'AppBundle\Entity\Pista',
            'query_builder' => function(EntityRepository $er) use ($tipus_pista){
                return $er->createQueryBuilder('pista')
                    ->where('pista.tipus_pista = :tipus_pista')
                    ->setParameter('tipus_pista', "1");
            }
        ));
    }

}