<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Project;
use Projet\YdaysManagerBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Report controller.
 *
 * @Route("report")
 */
class ReportController extends Controller
{
    /**
     * Lists all report entities.
     *
     * @Route("/", name="displayReport")
     * @Method("GET")
     */
    public function displayReportAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $reports = $em->getRepository('ProjetYdaysManagerBundle:Report')->findByProject($id);
        intval($id);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:affichageCr.html.twig', array(
            'reports' => $reports, 'projectId' => $id,
        ));
    }

    /**
     * Finds and displays a report entity.
     *
     * @Route("ficheProjet/allReports/report/{id}", name="projet_ydays_manager_display_one_cr")
     * @Method("GET")
     */
    public function displayOneReportAction($idReport)
    {
        $em = $this->getDoctrine()->getManager();

        $report = $em->getRepository('ProjetYdaysManagerBundle:Report')->find($idReport);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AffichageCompteRendu.html.twig', array(
            'report' => $report,
        ));
    }

    /**
     * Form to create a report entity.
     *
     * @Route("ficheProjet/allReports/newReport/{idProject}", name="projet_ydays_manager_create_one_cr")
     * @Method("GET")
     */
    public function createOneReportAction($idProject)
    {
        $em = $this->getDoctrine()->getManager();

        $report = $em->getRepository('ProjetYdaysManagerBundle:Report')->find($idProject);
        $project = $em->getRepository('ProjetYdaysManagerBundle:Project')->find($idProject);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AjoutCompteRendu.html.twig', array(
            'report' => $report, 'projectId' => $idProject, 'project' => $project,
        ));
    }

     /**
     * Push New Report in DataBase
     *
     * @Route("/pushReportInDb", options={"expose"=true}, name="projet_ydays_manager_push_report_in_db")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pushReportInDbAction(){
        $request = Request::createFromGlobals();
        $param = $request->query->all();

        $projectId = (urldecode($param['projectId']));

        $em = $this->getDoctrine()->getManager();
        $report =  $em->getRepository('ProjetYdaysManagerBundle:Report')->findByProject($projectId);
        $project = $em->getRepository(Project::class)->find($projectId);

        $nbCr=0;
        foreach ($report as $repNum) {
           $nbCr ++;
        }
        

        $newReport = new Report();
        $newReport -> setSessionReport(urldecode($param['globalReport']));
        $newReport -> setIndividualReport(urldecode($param['individualReport']));
        $newReport -> setObjectivesReport(urldecode($param['objectivesReport']));
        $newReport -> setNeedsReport(urldecode($param['needsReport']));
        $newReport -> setAnnexReport(urldecode($param['annexReport']));
        $newReport -> setProject($project);
        $newReport -> setNameReport("Compte rendu n°". ($nbCr+1));
        $newReport -> setDateReport(new \Datetime());
       
        $em -> persist($newReport);
        $em -> flush();

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:accueil.html.twig');
    }


}
