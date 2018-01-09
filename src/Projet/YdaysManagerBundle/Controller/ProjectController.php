<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\Entity\Comment;
use Projet\YdaysManagerBundle\Entity\AnswerComment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 * @Route("project")
 */
class ProjectController extends Controller
{
     /**
     * Lists all project entities.
     *
     * @Route("/", name="lesProjets")
     * @Method("GET")
     */
    public function lesProjetsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository('ProjetYdaysManagerBundle:Project')->findAll();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:lesProjets.html.twig', array(
            'projects' => $projects,
        ));
    }

    public function ficheProjetAction($id){
        $em = $this->getDoctrine()->getManager();

        $projectRepository = $em->getRepository(Project::class);
        $project = $projectRepository->find($id);

        $commentRepository = $em->getRepository(Comment::class);
        $comments = $commentRepository->findByProject($project);

        $answerCommentRepository = $em->getRepository(AnswerComment::class);
        $answerComments = $answerCommentRepository->findByComment($comments);

        return $this->render("ProjetYdaysManagerBundle:Project:ficheProjet.html.twig", array('project' => $project, 'comments' => $comments,'answerComments' => $answerComments ));
    }



    public function proposerProjetAction()
    {
        return $this->render('ProjetYdaysManagerBundle:Project:proposerProjet.html.twig');
    }

    /**
     * Push New Project in DataBase
     *
     * @Route("/pushProjectInDb", options={"expose"=true}, name="projet_ydays_manager_push_project_in_db")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pushProjectInDbAction(){
        $request = Request::createFromGlobals();
        $param = $request->query->all();

        $newProject = new Project();
        $newProject -> setName((urldecode($param['title'])));
        $newProject -> setIsPro(urldecode((int)$param['isPro']));
        $newProject -> setIsInternal(urldecode((int)$param['isInternal']));
        $newProject -> setImageName(urldecode($param['imageName']));
        $newProject -> setDescription(urldecode($param['description']));
        $newProject -> setState("STATE_REQUESTED");
        $newProject -> setProjectManager($this->get('security.token_storage')->getToken()->getUser());

        $em = $this -> getDoctrine() -> getManager();

        $em -> persist($newProject);
        $em -> flush();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:accueil.html.twig');
    }

    /**
     * Upload Image
     *
     * @Route("/uploadProjectImage", options={"expose"=true}, name="projet_ydays_manager_upload_project_image")
     * @Method("POST")
     */
    public function uploadProjectImage(){

    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('Projet\YdaysManagerBundle\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('projet_ydays_manager_fiche_projet', array('id' => $project->getId()));
        }

        return $this->render('project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{id}", name="project_show")
     * @Method("GET")
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $editForm = $this->createForm('Projet\YdaysManagerBundle\Form\ProjectType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_edit', array('id' => $project->getId()));
        }

        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
