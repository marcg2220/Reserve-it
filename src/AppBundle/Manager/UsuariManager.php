<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 17/01/2018
 * Time: 12:29
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Usuari;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UsuariManager
{
    /** @var ObjectManager */
    private $em;
    /** @var EncoderFactoryInterface */
    private $encoderFactory;
    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(ObjectManager $entityManager, EncoderFactoryInterface $encoderFactory, TokenStorageInterface $tokenStorage)
    {
        $this->em = $entityManager;
        $this->encoderFactory = $encoderFactory;
        $this->tokenStorage = $tokenStorage;
    }

    public function guardar(Usuari $usuari)
    {
        if (null !== $usuari->getPasswordEnClar())
        {
            $this->codificarPassword($usuari);
        }

        $this->em->persist($usuari);
        $this->em->flush();
    }

    public function loguejar(Usuari $usuari)
    {
        $token = new UsernamePasswordToken($usuari, null, 'frontend', $usuari->getRoles());
        $this->tokenStorage->setToken($token);
    }

    private function codificarPassword(Usuari $usuari)
    {
        $encoder = $this->encoderFactory->getEncoder($usuari);
        $passwordCodificat = $encoder->encodePassword($usuari->getPasswordEnClar(), $usuari->getSalt());
        $usuari->setPassword($passwordCodificat);
    }

}