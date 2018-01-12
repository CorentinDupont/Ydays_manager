<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Desire
 *
 * @ORM\Table(name="desire")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\DesireRepository")
 */
class Desire
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
     * @ORM\Column(name="type", type="string", length=191)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerUserBundle\Entity\User", inversedBy="desires")
     * @ORM\JoinColumn(name="User_Id", referencedColumnName="id")
     */
    private $requester;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Project")
     * @ORM\JoinColumn(name="Project_Id", referencedColumnName="id", nullable=true)
     */
    private $linkedProject;

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
     * Set type
     *
     * @param string $type
     *
     * @return Desire
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set requester
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $requester
     *
     * @return Desire
     */
    public function setRequester(\Projet\YdaysManagerUserBundle\Entity\User $requester = null)
    {
        $this->requester = $requester;

        return $this;
    }

    /**
     * Get requester
     *
     * @return \Projet\YdaysManagerUserBundle\Entity\User
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * Set linkedProject
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $linkedProject
     *
     * @return Desire
     */
    public function setLinkedProject(\Projet\YdaysManagerBundle\Entity\Project $linkedProject = null)
    {
        $this->linkedProject = $linkedProject;

        return $this;
    }

    /**
     * Get linkedProject
     *
     * @return \Projet\YdaysManagerBundle\Entity\Project
     */
    public function getLinkedProject()
    {
        return $this->linkedProject;
    }
}
