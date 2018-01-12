<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 09/01/2018
 * Time: 22:06
 */

namespace Projet\YdaysManagerBundle\Controller;


use Projet\YdaysManagerBundle\Entity\AnswerComment;
use Projet\YdaysManagerBundle\Entity\Comment;
use Projet\YdaysManagerBundle\Entity\Desire;
use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerUserBundle\Entity\User;
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


    /**
     * Demande d'affectation d'un utilisateur à un projet
     *
     *
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function askAffectProjAction($idProject){

        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository(Project::class);

        $desire = new Desire();
        $desire->setType("TYPE_AFFECTATION_REQUEST");
        $desire->setRequester($this->get('security.token_storage')->getToken()->getUser());
        $desire->setLinkedProject($projectRepository->find($idProject));

        $em->persist($desire);

        $em->flush();


        $student = $this->getDoctrine()
            -> getRepository(User::class)
            -> searchStudent();

        $projectRepository = $em->getRepository(Project::class);
        $project = $projectRepository->find($idProject);

        $commentRepository = $em->getRepository(Comment::class);
        $comments = $commentRepository->findByProject($project);

        $answerCommentRepository = $em->getRepository(AnswerComment::class);
        $answerComments = $answerCommentRepository->findByComment($comments);

        return $this->render("ProjetYdaysManagerBundle:Project:ficheProjet.html.twig", array('project' => $project, 'comments' => $comments,'answerComments' => $answerComments, 'student'=>$student));
    }

    /**
     * Validation d'affectation par l'administrateur
     *
     * @Route("/Desire/setAffectAvailable/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_desire_set_affect_available")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function affectUserAction($idProject, $idDesire){

        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);
        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->findById($this->get('security.token_storage')->getToken()->getUser());

        //Rajout d'un membre dans le projet
        $projectToUpdate = $projectRepository->find($idProject);
        $projectToUpdate->getMembers($user);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:adminDemande.html.twig', array('desires'=>$allDesires));
    }

    /**
     * Refus d'affectation par l'administrateur
     *
     * @Route("/Desire/refuseAffectProject/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_refuse_affect_project")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refuseAffectAction($idProject, $idDesire){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }

    /**
     * Demande de suppression d'un projet de la part d'un utilisateur
     *
     *
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function askSupprProjAction($idProject){

        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository(Project::class);

        $desire = new Desire();
        $desire->setType("TYPE_DELETE_PROJECT");
        $desire->setRequester($this->get('security.token_storage')->getToken()->getUser());
        $desire->setLinkedProject($projectRepository->find($idProject));

        $em->persist($desire);

        $em->flush();


        $student = $this->getDoctrine()
            -> getRepository(User::class)
            -> searchStudent();

        $projectRepository = $em->getRepository(Project::class);
        $project = $projectRepository->find($idProject);

        $commentRepository = $em->getRepository(Comment::class);
        $comments = $commentRepository->findByProject($project);

        $answerCommentRepository = $em->getRepository(AnswerComment::class);
        $answerComments = $answerCommentRepository->findByComment($comments);

        return $this->render("ProjetYdaysManagerBundle:Project:ficheProjet.html.twig", array('project' => $project, 'comments' => $comments,'answerComments' => $answerComments, 'student'=>$student));
    }

    /**
     * Validation de suppression par l'administrateur
     *
     * @Route("/Desire/supprProjectAvailable/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_suppr_project_available")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supprProjectAvailableAction($idProject, $idDesire){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        //Changement d'état du projet
        $projectToUpdate = $projectRepository->find($idProject);
        $projectToUpdate->setState("STATE_DELETED");

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }

    /**
     * Refus de suppression par l'administrateur
     *
     * @Route("/Desire/refuseSupprProject/project={idProject}&desire={idDesire}", options={"expose"=true}, name="projet_ydays_manager_refuse_suppr_project")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refuseSupprProjectAction($idProject, $idDesire){
        $em = $this->getDoctrine()->getManager();
        $desireRepository = $em->getRepository(Desire::class);
        $projectRepository = $em->getRepository(Project::class);

        //suppression de la demande
        $desireToDelete = $desireRepository->find($idDesire);
        $em->remove($desireToDelete);

        $em->flush();

        $allDesires = $desireRepository->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AdminDemande.html.twig', array('desires'=>$allDesires));
    }
}