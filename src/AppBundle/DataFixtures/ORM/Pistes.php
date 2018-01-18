<?php
/**
 * Created by PhpStorm.
 * User: mgarcia
 * Date: 11/01/2018
 * Time: 10:30
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Pista;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class Pistes extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $pistes_padel = $manager->getRepository('AppBundle:Pista')->findBy(['tipus_pista' => 1]);
        $pistes_tenis = $manager->getRepository('AppBundle:Pista')->findBy(['tipus_pista' => 2]);
        $pistes = array(
            array('id' => 1, 'tipus_pista' => 1),
            array('id' => 2, 'tipus_pista' => 1),
            array('id' => 1, 'tipus_pista' => 2),
            array('id' => 2, 'tipus_pista' => 2),
            array('id' => 3, 'tipus_pista' => 2),
            array('id' => 4, 'tipus_pista' => 2)
        );

        $num_pista_padel = sizeof($pistes_padel);
        $num_pista_tenis = sizeof($pistes_tenis);

        foreach ($pistes as $pista)
        {
            $entitat = new Pista();
            $entitat->setId($pista['id']);
            if ($pista['tipus_pista']==1)
            {
                $entitat->setNumPista($num_pista_padel+1);
                $entitat->setTipusPista($this->getReference('tipusPadel'));
                ++$num_pista_padel;
            }
            else
            {
                $entitat->setNumPista($num_pista_tenis+1);
                $entitat->setTipusPista($this->getReference('tipusTenis'));
                ++$num_pista_tenis;
            }

            $manager->persist($entitat);

        }
        $manager->flush();



    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}