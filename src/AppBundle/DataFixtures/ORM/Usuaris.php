<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 11/01/2018
 * Time: 11:55
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Usuari;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Usuaris extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $usuaris = array(
            array('nom' => 'Marc', 'cognoms' => 'Garcia Mir', 'email' => 'mrcgrciamr@gmail.com', 'pasword' => '123456789', 'dni' => '40369698Y', 'accepta_email' => 'true')
        );

        foreach ($usuaris as $usuari)
        {
            $entitat = new Usuari();

            $entitat->setNom($usuari['nom']);
            $entitat->setCognoms($usuari['cognoms']);
            $entitat->setEmail($usuari['email']);
            $entitat->setPassword($usuari['pasword']);
            $entitat->setDni($usuari['dni']);
            $entitat->setAcceptaEmail($usuari['accepta_email']);
            $entitat->setDataAlta(new \DateTime());
            $entitat->setDataNaixement(new \DateTime('1988-06-26'));

            $manager->persist($entitat);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}