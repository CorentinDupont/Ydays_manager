<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/01/2018
 * Time: 09:28
 */

namespace Projet\YdaysManagerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\YdaysManagerBundle\Entity\Project;

class LoadProject implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'The Legend Of Zelda - The Dark Side Of Dimension',
            'Domotique',
            'Maison sous l\'eau',
            'Strange eye',
            'Batman : The movie'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $project = new Project();
            $project->setName($name);

            // On la persiste
            $manager->persist($project);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}