<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 18/01/2018
 * Time: 12:17
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Reserva;
use AppBundle\Form\ReservaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ReservaController
 * @package AppBundle\Controller
 * @Route("/reserva")
 */
class ReservaController extends Controller
{
    /**public function reservaAction($usuari)
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
    }*/


    /**
     * @Route("/novaReserva", name="nova_reserva")
     */
    public function reservaAction(Request $request)
    {

        $formulariReserva = $this->createForm(new ReservaType(),$reserva = new Reserva());
        $formulariReserva->handleRequest($request);

        if ($formulariReserva->isSubmitted() and $formulariReserva->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($reserva);
            $em->flush();

            return $this->redirectToRoute('portada');
        }

        return $this->render('reserva/nova_reserva.html.twig', array(
            'formulariReserva' => $formulariReserva->createView(),
        ));


    }

}