<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 12/12/2017
 * Time: 15:29
 */

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\Entity\Promotion;
use Projet\YdaysManagerUserBundle\Entity\User;
use Projet\YdaysManagerBundle\ProjetYdaysManagerBundle;
use Projet\YdaysManagerUserBundle\ProjetYdaysManagerUserBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class YdaysManagerController extends Controller
{
    /**
     * @Route("/accueil", name="accueilAction")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accueilAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:accueil.html.twig');
    }

    public function loginAction(){
        return $this -> render('ProjetYdaysManagerBundle:YdaysManager:login.html.twig');
    }

    /**
     * @Route("/testLogin", name="testLogin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testLoginAction(){
        //Traitement

        //Si OK :
        return $this->redirect('/accueil');
        //Sinoon
        //return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig');
    }

    public function ficheProjetAction($id){
        return $this->render("ProjetYdaysManagerBundle:YdaysManager:ficheProjet.html.twig", array('id' => $id));
    }

    public function proposerProjetAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ProposerProjet.html.twig');
    }

    public function lesProjetsAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:lesProjets.html.twig');
    }

    public function listeEtudiantAction(){
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);
        $promotionRepository = $em->getRepository(Promotion::class);
        $projectRepository = $em->getRepository(Project::class);

        /*foreach($userRepository->findAll() as $user){
            foreach($projectRepository->findAll() as $project){
                $user->addProject($project);
            }
            foreach($promotionRepository->findAll() as $promotion){
                $user->setPromotion($promotion);
            }
        }
        $em -> flush();*/

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListeEtudiant.html.twig', array('promotions' => $promotionRepository->findAll()));
    }

    public function listeObjectifAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListeObjectif.html.twig');
    }

    /*public function listEntreprisesAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListEntreprises.html.twig');
    }*/

    public function affichageCrAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:affichageCr.html.twig');
    }

    public function adminDemandeAction(){
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig');
    }

}