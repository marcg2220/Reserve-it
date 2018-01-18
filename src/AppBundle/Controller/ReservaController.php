<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 18/01/2018
 * Time: 12:17
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ReservaController extends Controller
{
    public function reservaAction($usuari)
    {
        $em = $this->getDoctrine()->getManager();

        $reserva = $em->getRepository('AppBundle:Reserva')->findReserva($usuari);

        if (!reserva)
        {
            throw $this->createNotFoundException('No hi ha reserves per aquest usuari');
        }

        return $this->render('reserva/detall.html.twig', array(
            'reserva' => $reserva,
        ));
    }

}