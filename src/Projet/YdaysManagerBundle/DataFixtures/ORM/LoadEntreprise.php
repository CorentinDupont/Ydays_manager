<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 11/01/2018
 * Time: 01:28
 */

namespace Projet\YdaysManagerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\YdaysManagerBundle\Entity\Entreprise;

class LoadEntreprise implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Sogeti',
            'Tan'
        );

        foreach ($names as $index=>$name) {
            $entreprise = new Entreprise();
            $entreprise ->setAdresseEntreprise("Adresse de l'entreprise");
            $entreprise ->setCpEntreprise("44000");
            $entreprise ->setImgEntreprise("tan.jpg");
            $entreprise ->setInfoEntreprise("Des informations très intéressantes");
            $entreprise ->setNomEntreprise($name);
            $entreprise ->setSiretEntreprise("Siret 49845321897".$index);
            $entreprise ->setVilleEntreprise("Nantes");

            $manager->persist($entreprise);
        }

        $manager->flush();
    }
}