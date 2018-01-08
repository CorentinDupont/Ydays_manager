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
            'reports' => $reports,
        ));
    }

    /**
     * Finds and displays a report entity.
     *
     * @Route("/{id}", name="report_show")
     * @Method("GET")
     */
    public function showAction(Report $report)
    {

        return $this->render('report/show.html.twig', array(
            'report' => $report,
        ));
    }
}
