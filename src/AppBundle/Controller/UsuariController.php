<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 14/01/2018
 * Time: 12:09
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Usuari;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UsuariController
 * @package AppBundle\Controller
 * @Route("/usuari")
 */
class UsuariController extends Controller
{

    /**
     * @Route("/login", name="usuari_login")
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('usuari/login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="usuari_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="usuari_logout")
     */
    public function logout()
    {

    }

    public function caixaLoginAction()
    {
        $usuari = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('usuari/login.html.twig', array(
            'usuari' => $usuari,
            ));
    }

    /**
     * @Route("/registre", name="usuari_registre")
     */
    public function registreAction(Request $request)
    {
        $usuari = new Usuari();
        $usuari->setAcceptaEmail(true);
        $formulari = $this->createForm('AppBundle\Form\UsuariType', $usuari, array(
            'accio' => 'crear_usuari',
            'validation_groups' => array('default', 'registre'),
        ));

        $formulari->handleRequest($request);
        if ($formulari->isValid())
        {
            $this->get('app.manager.usuari_manager')->guardar($usuari);
            $this->get('app.manager.usuari_manager')->loguejar($usuari);

            $this->addFlash('info', "Enhorabona! T'has registrat correctament a Reserve'it");

            return $this->redirectToRoute('portada');

        }

        return $this->render('usuari/registre.html.twig', array(
            'formulari' => $formulari->createView(),
        ));
    }

    /**
     * @Route("/perfil", name="usuari_perfil")
     */
    public function perfilAction(Request $request)
    {
        $usuari = $this->getUser();
        $formulari = $this->createForm('AppBundle\Form\UsuariType', $usuari);

        $formulari->handleRequest($request);

        if ($formulari->isValid())
        {
            $this->get('app.manager.usuari_manager')->guardar($usuari);
            $this->addFlash('info', "Les dades del teu perfil s'han actualitzat correctament");

            return $this->redirectToRoute('usuari_perfil');
        }

        return $this->render('usuari/perfil.html.twig', array(
            'usuari' => $usuari,
            'formulari' => $formulari->createView(),
        ));

    }




    /**
     * @Route("/reserves", name="usuari_reserves")
     */
    public function reservesAction()
    {
        $usuariId = 1;

        $em = $this->getDoctrine()->getManager();
        $reserves = $em->getRepository('AppBundle:Usuari')->findReservesUsuari($usuariId);

        return $this->render('usuari/reserves.html.twig', array('reserves' => $reserves));
    }



}