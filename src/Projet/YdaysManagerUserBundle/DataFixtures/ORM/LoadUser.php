<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/01/2018
 * Time: 09:54
 */

namespace Projet\YdaysManagerUserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Projet\YdaysManagerUserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = new User() ;
        $admin->setEmail("corentin.dupont@ynov.com") ;
        $admin->setUsername("corentin") ;
        $admin->setPlainPassword("azerty") ;
        $admin->setEnabled(true) ;
        $admin->setSuperAdmin(true) ;
        $admin->setRoles( array('ROLE_SUPER_ADMIN') ) ;

        $admin2 = new User() ;
        $admin2->setEmail("charles.huet@ynov.com") ;
        $admin2->setUsername("charles") ;
        $admin2->setPlainPassword("azerty") ;
        $admin2->setEnabled(true) ;
        $admin2->setRoles( array('ROLE_ADMIN') ) ;

        $helper = new User() ;
        $helper->setEmail("maxime.grand@ynov.com") ;
        $helper->setUsername("maxime") ;
        $helper->setPlainPassword("azerty") ;
        $helper->setEnabled(true) ;
        $helper->setRoles( array('ROLE_HELPER') ) ;

        $projectManager = new User() ;
        $projectManager->setEmail("jérémy.nunes@ynov.com") ;
        $projectManager->setUsername("jérémy") ;
        $projectManager->setPlainPassword("azerty") ;
        $projectManager->setEnabled(true) ;
        $projectManager->setRoles( array('ROLE_PROJECT_MANAGER') ) ;

        $manager->persist($admin);
        $manager->persist($admin2);
        $manager->persist($helper);
        $manager->persist($projectManager);

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}