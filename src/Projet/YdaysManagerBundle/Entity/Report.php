<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\ReportRepository")
 */
class Report
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nameReport", type="string")
     */
    private $nameReport;

    /**
     * @var string
     *
     * @ORM\Column(name="sessionReport", type="string")
     */
    private $sessionReport;

    /**
     * @var string
     *
     * @ORM\Column(name="individualReport", type="string")
     */
    private $individualReport;

    /**
     * @var string
     *
     * @ORM\Column(name="objectivesReport", type="string")
     */
    private $objectivesReport;

    /**
     * @var string
     *
     * @ORM\Column(name="needsReport", type="string")
     */
    private $needsReport;

    /**
     * @var string
     *
     * @ORM\Column(name="annexReport", type="string")
     */
    private $annexReport;
    
    /**
     * @var date
     *
     * @ORM\Column(name="dateReport", type="date")
     */
    private $dateReport;

    /**
     * @var int
     *
     * @ORM\Column(name="mark_report", type="integer", nullable=true)
     */
    private $markReport;

    /**
    * @var int
    * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Project")
    * @ORM\JoinColumn(nullable=false)
    */
    private $project;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sessionReport
     *
     * @param string $sessionReport
     *
     * @return report
     */
    public function setSessionReport($sessionReport)
    {
        $this->sessionReport = $sessionReport;

        return $this;
    }

    /**
     * Get sessionReport
     *
     * @return string
     */
    public function getSessionReport()
    {
        return $this->sessionReport;
    }

    /**
     * Set individualReport
     *
     * @param string $individualReport
     *
     * @return report
     */
    public function setIndividualReport($individualReport)
    {
        $this->individualReport = $individualReport;

        return $this;
    }

    /**
     * Get individualReport
     *
     * @return string
     */
    public function getIndividualReport()
    {
        return $this->individualReport;
    }

    /**
     * Set objectivesReport
     *
     * @param string $objectivesReport
     *
     * @return report
     */
    public function setObjectivesReport($objectivesReport)
    {
        $this->objectivesReport = $objectivesReport;

        return $this;
    }

    /**
     * Get objectivesReport
     *
     * @return string
     */
    public function getObjectivesReport()
    {
        return $this->objectivesReport;
    }

    /**
     * Set needsReport
     *
     * @param string $needsReport
     *
     * @return report
     */
    public function setNeedsReport($needsReport)
    {
        $this->needsReport = $needsReport;

        return $this;
    }

    /**
     * Get needsReport
     *
     * @return string
     */
    public function getNeedsReport()
    {
        return $this->needsReport;
    }

    /**
     * Set annexReport
     *
     * @param string $annexReport
     *
     * @return report
     */
    public function setAnnexReport($annexReport)
    {
        $this->annexReport = $annexReport;

        return $this;
    }

    /**
     * Get annexReport
     *
     * @return string
     */
    public function getAnnexReport()
    {
        return $this->annexReport;
    }

    /**
     * Set project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     *
     * @return Report
     */
    public function setProject(\Projet\YdaysManagerBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Projet\YdaysManagerBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set markReport
     *
     * @param integer $markReport
     *
     * @return Report
     */
    public function setMarkReport($markReport)
    {
        $this->markReport = $markReport;

        return $this;
    }

    /**
     * Get markReport
     *
     * @return integer
     */
    public function getMarkReport()
    {
        return $this->markReport;
    }

    /**
     * Set nameReport
     *
     * @param string $nameReport
     *
     * @return Report
     */
    public function setNameReport($nameReport)
    {
        $this->nameReport = $nameReport;

        return $this;
    }

    /**
     * Get nameReport
     *
     * @return string
     */
    public function getNameReport()
    {
        return $this->nameReport;
    }

    /**
     * Set dateReport
     *
     * @param \DateTime $dateReport
     *
     * @return Report
     */
    public function setDateReport($dateReport)
    {
        $this->dateReport = $dateReport;

        return $this;
    }

    /**
     * Get dateReport
     *
     * @return \DateTime
     */
    public function getDateReport()
    {
        return $this->dateReport;
    }
}
