<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Desire;
use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\Entity\Comment;
use Projet\YdaysManagerBundle\Entity\AnswerComment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Project controller.
 *
 *@Route("project")
 */
class ProjectController extends Controller
{
    /**
     * Lists all project entities by current user id.
     *
     * @Route("/", name="myProjects")
     * @Method("GET")
     */
    public function myProjectsAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user -> getId();

        $em = $this->getDoctrine()->getManager();

        //WARNING : les lignes de code qui vont suivre sont susceptibles de choquer les âmes les plus sensibles.

        $projectsQuery = $em->getRepository('ProjetYdaysManagerBundle:Project')->findAll();

        $projects = [];
        foreach($projectsQuery as $project){
            $projectUsers = $project -> getMembers();
            $projectManagers = $project -> getProjectManager();
            foreach($projectUsers as $projectUser){
                foreach( $projectManagers as $projectManager){
                    if($userId == $projectUser->getId() || $userId == $projectManager->getId()){
                        array_push($projects, $project);
                    }
                }
            }
        }
        
        return $this->render('ProjetYdaysManagerBundle:YdaysManager:lesProjets.html.twig', array(
            'projects' => $projects
            )
        );
    }

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

        //Création du nouveau projet
        $newProject = new Project();
        $newProject -> setName((urldecode($param['title'])));
        if($param['isPro']){
            $isPro = 1;
        }else{
            $isPro = 0;
        }
        $newProject -> setIsPro($isPro);
        if($param['isInternal']){
            $isInternal = 1;
        }else{
            $isInternal = 0;
        }
        $newProject -> setIsInternal($isInternal);
        $newProject -> setImageName(urldecode($param['imageName']));
        $newProject -> setDescription(urldecode($param['description']));
        $newProject -> setState("STATE_REQUESTED");
        $newProject -> setProjectManager($this->get('security.token_storage')->getToken()->getUser());

        //Création de la demande pour l'admin
        $desire = new Desire();
        $desire -> setLinkedProject($newProject);
        $desire -> setRequester($newProject->getProjectManager());
        $desire ->setType("TYPE_PROJECT_REQUEST");

        $em = $this -> getDoctrine() -> getManager();

        //On dit au manager de prendre en compte nos nouvelles entités
        $em -> persist($newProject);
        $em -> persist($desire);

        //On valide l'insertion en base de donnée.
        $em -> flush();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:accueil.html.twig');
    }

    /**
     * UpdateTitle
     *
     * @Route("/ficheProjet/updateTitle", options={"expose"=true}, name="projet_ydays_manager_project_update_title")
     * @Method("POST")
     * @return Response
     * @return JsonResponse
     */
    public function updateTitleAction(Request $request){
        if($request->isXmlHttpRequest()){

            $em = $this -> getDoctrine()->getManager();
            $projectToUpdate = $em->getRepository(Project::class)->find($request->get('idProject'));
            $projectToUpdate->setName($request->get('newTitle'));

            $em->flush();

            return new JsonResponse(array('data' => 'ok'));
        }


        return new Response(
            'Erreur : Page appelée avec une autre méthode que ajax.'
        );
    }

    /**
     * UpdateDesription
     *
     * @Route("/ficheProjet/updateDescription", options={"expose"=true}, name="projet_ydays_manager_project_update_description")
     * @Method("POST")
     * @return Response
     * @return JsonResponse
     */
    public function updateDescriptionAction(Request $request){
        if($request->isXmlHttpRequest()){

            $em = $this -> getDoctrine()->getManager();
            $projectToUpdate = $em->getRepository(Project::class)->find($request->get('idProject'));
            $projectToUpdate->setDescription($request->get('newDescription'));

            $em->flush();

            return new JsonResponse(array('data' => 'ok'));
        }


        return new Response(
            'Erreur : Page appelée avec une autre méthode que ajax.'
        );
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
