<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function defaultAction()
    {
        $usuari = $this->getUser();
        $nom = $usuari->getNom();
    }

    /**
     * @Route("/", name="portada")
     */
    public function portadaAction()
    {
        return $this->render('portada.html.twig');
    }

    /**
     * @Route("/lloc/{nomPagina}/", name="pagina", requirements={ "nomPagina"="ajuda|privacitat" })
     * @return Response
     */
    public function paginaAction($nomPagina)
    {
        return $this->render('lloc/'.$nomPagina.'.html.twig');
    }


}
