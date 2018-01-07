<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/01/2018
 * Time: 13:02
 */

namespace Projet\YdaysManagerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\YdaysManagerBundle\Entity\Promotion;


class LoadPromotion implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $promotion1 = new Promotion();
        $promotion1 -> setName('Ingésup B1');

        $promotion2 = new Promotion();
        $promotion2 -> setName('Ingésup B2');

        $promotion3 = new Promotion();
        $promotion3 -> setName('Ingésup B3');

        $promotion4 = new Promotion();
        $promotion4 -> setName('Ingésup M1');

        $promotion5 = new Promotion();
        $promotion5 -> setName('Ingésup M2');

        $manager->persist($promotion1);
        $manager->persist($promotion2);
        $manager->persist($promotion3);
        $manager->persist($promotion4);
        $manager->persist($promotion5);

        $manager->flush();
    }
}