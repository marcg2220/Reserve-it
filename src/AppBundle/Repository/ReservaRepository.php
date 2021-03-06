<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ReservaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservaRepository extends EntityRepository
{
    public function findAllReservesUsuari($usuari)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('SELECT u FROM AppBundle:Usuari u WHERE u.id = :dni ORDER BY u.data_Alta DESC');
        $consulta->setParameter('dni', $usuari->getDni());
        $consulta->setMaxResults(20);
        $usuaris = $consulta->getResult();

        return $usuaris;
    }
}
