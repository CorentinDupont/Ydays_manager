<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 08/01/2018
 * Time: 09:15
 */

namespace Projet\YdaysManagerBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\YdaysManagerBundle\Entity\Comment;

class LoadComment implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $commentTexts = array(
            'Un commentaire structuré et bref',
            'Une réponse d\'un commentaire structuré et bref',
            'Un commentaire étrange',
            'Une réponse d\'un commentaire étrange',
            'Une deuxième réponse d\'un commentaire vraiment étrange'
        );

        foreach ($commentTexts as $index=>$commentText) {
            $comment = new Comment();
            $comment->setText($commentText);

            $manager->persist($comment);
        }

        $manager->flush();
    }

}