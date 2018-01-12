<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Promotion;
use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerUserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Projet\YdaysManagerBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;


/**
 * Helper controller.
 *
 * @Route("helper")
 */
class HelperController extends Controller
{
    /**
     * Lists all helper entities.
     *
     * @Route("/helpers", name="helpers")
     * @Method("GET")
     */
    public function listHelperAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);
        $promotionRepository = $em->getRepository(Promotion::class);
        $projectRepository = $em->getRepository(Project::class);
        
        $userQuery = $userRepository->findAll();
        $users=[];
        foreach($userQuery as $usersLoop){
            if ($usersLoop->hasRole('ROLE_HELPER')) {
                array_push($users, $usersLoop);
            }
        }
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListeEtudiant.html.twig', array('promotions' => $promotionRepository->findAll(), 'users' => $users ));


    }
}