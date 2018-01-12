<?php
namespace Projet\YdaysManagerBundle\Controller;


use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\Entity\Objective;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
/**
 * objective controller.
 *
 * @Route("objective")
 */
class ObjectiveController extends Controller
{
    /**
     * Lists all objectives entities.
     *
     * @Route("/", name="displayChecklist")
     * @Method("GET")
     */
    public function displayChecklistAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $objectives = $em->getRepository('ProjetYdaysManagerBundle:Objective')->findByProject($id);
        intval($id);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListeObjectif.html.twig', array(
            'objectives' => $objectives, 'projectId' => $id,
        ));
    }

    /**
     * Push New Objective in DataBase
     *
     * @Route("/newObjective", options={"expose"=true}, name="projet_ydays_manager_push_objective_in_db")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pushObjectiveInDbAction(){
        $request = Request::createFromGlobals();
        $param = $request->query->all();
        $em = $this -> getDoctrine() -> getManager();
        
        $projectId = (urldecode($param['projectId']));
        
        $project = $em->getRepository(Project::class)->find($projectId);
        
        //Création du nouvel objectif
        $newObjective = new Objective();
        $newObjective -> setTextObjective((urldecode($param['textObjective'])));
        $newObjective -> setChecked(0);
        $newObjective -> setProject($project);
      
        //On dit au manager de prendre en compte nos nouvelles entités
        $em -> persist($newObjective);

        //On valide l'insertion en base de donnée.
        $em -> flush();
        $objectives = $em->getRepository('ProjetYdaysManagerBundle:Objective')->findByProject($projectId);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:ListeObjectif.html.twig',  array('projectId'=>$projectId, 'objectives'=> $objectives));
    }
    


/**
     * UpdateCheckState
     *
     * @Route("/checklist/updateCheckState", options={"expose"=true}, name="projet_ydays_manager_project_update_checkbox_state")
     * @Method("POST")
     * @return Response
     * @return JsonResponse
     */
    public function updateObjectiveInDbAction(Request $request){
        if($request->isXmlHttpRequest()){

            $em = $this -> getDoctrine()->getManager();
            $objectiveToUpdate = $em->getRepository(Objective::class)->find($request->get('projectId'));
            $objectiveToUpdate->setChecked($request->get('checkedState'));

            $em->flush();

            return new JsonResponse(array('data' => 'ok'));
        }


        return new Response(
            'Erreur : Page appelée avec une autre méthode que ajax.'
        );
    }

}