<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 12/01/2018
 * Time: 18:51
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Pista;
use Doctrine\ORM\EntityRepository;

class PistaRepository extends EntityRepository
{
    public function findAllByTipusPista($tipus_pista)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('SELECT p FROM AppBundle:Pista p WHERE p.tipus_pista = :tipus_pista');
        $consulta->setParameter('tipus_pista', $tipus_pista->getId());
        $pistes = $consulta->getResult();

        return $pistes;
    }

}