<?php

namespace Projet\YdaysManagerBundle\Controller;

use Projet\YdaysManagerBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * Create and displays a report entity.
     *
     * @Route("ficheProjet/allReports/report/{idProject}", name="projet_ydays_manager_create_one_cr")
     * @Method("GET")
     */
    public function createOneReportAction($idProject)
    {
        $em = $this->getDoctrine()->getManager();

        $report = $em->getRepository('ProjetYdaysManagerBundle:Report')->find($idProject);

        return $this->render('ProjetYdaysManagerBundle:YdaysManager:AffichageCompteRendu.html.twig', array(
            'report' => $report,
        ));

    
    }
}
