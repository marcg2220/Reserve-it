<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 12/01/2018
 * Time: 09:58
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\TipusPista;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TipusPistes extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $padel = new TipusPista();
        $padel->setId(1);
        $padel->setDescripcio('Padel');


        $tenis = new TipusPista();
        $tenis->setId(2);
        $tenis->setDescripcio('Tenis');


        $manager->persist($padel);
        $manager->persist($tenis);

        $manager->flush();
        $this->addReference('tipusPadel', $padel);
        $this->addReference('tipusTenis',$tenis);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}