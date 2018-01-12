<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objective
 *
 * @ORM\Table(name="objective")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\ObjectiveRepository")
 */
class Objective
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
     * @var boolean
     *
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;

    /**
     * @var string
     *
     * @ORM\Column(name="textObjective", type="string", length=191)
     */
    private $textObjective;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Project", inversedBy="objectives")
     * @ORM\JoinColumn(name="project_Id", referencedColumnName="id")
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
     * Set checked
     *
     * @param integer $checked
     *
     * @return Objective
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return int
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set textObjective
     *
     * @param string $textObjective
     *
     * @return Objective
     */
    public function setTextObjective($textObjective)
    {
        $this->textObjective = $textObjective;

        return $this;
    }

    /**
     * Get textObjective
     *
     * @return string
     */
    public function getTextObjective()
    {
        return $this->textObjective;
    }

    /**
     * Set project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     *
     * @return Objective
     */
    public function setProject(\Projet\YdaysManagerBundle\Entity\Project $project = null)
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
}
