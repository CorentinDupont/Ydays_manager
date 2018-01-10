<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 09/01/2018
 * Time: 22:06
 */

namespace Projet\YdaysManagerBundle\Controller;


use Projet\YdaysManagerBundle\Entity\Desire;
use Projet\YdaysManagerBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Desire Controller
 */
class DesireController extends Controller
{

    /**
     * Afficher toutes les demandes à l'administrateur
     */
    public function adminDemandeAction(){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }

    /**
     * Validation d'un projet par l'administrateur
     *
     * @Route("/Desire/setProjectAvailable/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_desire_set_available")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function setProjectAvailableAction($idProject, $idDesire){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        //Changement d'état du projet
        $projectToUpdate = $projectRepository->find($idProject);
        $projectToUpdate->setState("STATE_AVAILABLE");

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }

    /**
     * Refus d'un projet par l'administrateur
     *
     * @Route("/Desire/refuseProject/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_desire_refuse_project")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refuseProjectAction($idProject, $idDesire){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        //suppression du projet
        $projectToDelete = $projectRepository->find($idProject);
        $em->remove($projectToDelete);

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }
}