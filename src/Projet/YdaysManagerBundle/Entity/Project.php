<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=191)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Projet\YdaysManagerUserBundle\Entity\User")
     */
    private $members;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Is_Pro", type="boolean")
     */
    private $isPro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Is_Internal", type="boolean")
     */
    private $isInternal;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_Name", type="string", length=191)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="Classroom", type="string", length=191)
     */
    private $classroom;

    /**
     * @var string
     *
     * @ORM\Column(name="State", type="string", length=50)
     */
    private $state;

    /**
    *
    * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Entreprise", inversedBy="projects")
    * @ORM\JoinColumn(name="Entreprise_Id", referencedColumnName="id")
    */
    private $entreprise;
    /** 
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerUserBundle\Entity\User")
     * @ORM\JoinColumn(name="Project_Manager_Id", referencedColumnName="id")
     */
    private $projectManager;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerUserBundle\Entity\User")
     * @ORM\JoinColumn(name="Helper_Id", referencedColumnName="id")
     */
    private $helper;

    /**
     * @ORM\OneToMany(targetEntity="Projet\YdaysManagerBundle\Entity\Comment", mappedBy="project")
     */
    private $comments;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

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
     * Add member
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $member
     *
     * @return Project
     */
    public function addMember(\Projet\YdaysManagerUserBundle\Entity\User $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $member
     */
    public function removeMember(\Projet\YdaysManagerUserBundle\Entity\User $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isPro
     *
     * @param boolean $isPro
     *
     * @return Project
     */
    public function setIsPro($isPro)
    {
        $this->isPro = $isPro;

        return $this;
    }

    /**
     * Get isPro
     *
     * @return boolean
     */
    public function getIsPro()
    {
        return $this->isPro;
    }

    /**
     * Set isInternal
     *
     * @param boolean $isInternal
     *
     * @return Project
     */
    public function setIsInternal($isInternal)
    {
        $this->isInternal = $isInternal;

        return $this;
    }

    /**
     * Get isInternal
     *
     * @return boolean
     */
    public function getIsInternal()
    {
        return $this->isInternal;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Project
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set projectManager
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $projectManager
     *
     * @return Project
     */
    public function setProjectManager(\Projet\YdaysManagerUserBundle\Entity\User $projectManager = null)
    {
        $this->projectManager = $projectManager;

        return $this;
    }

    /**
     * Get projectManager
     *
     * @return \Projet\YdaysManagerUserBundle\Entity\User
     */
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * Set helper
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $helper
     *
     * @return Project
     */
    public function setHelper(\Projet\YdaysManagerUserBundle\Entity\User $helper = null)
    {
        $this->helper = $helper;

        return $this;
    }

    /**
     * Get helper
     *
     * @return \Projet\YdaysManagerUserBundle\Entity\User
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     * Add comment
     *
     * @param \Projet\YdaysManagerBundle\Entity\Comment $comment
     *
     * @return Project
     */
    public function addComment(\Projet\YdaysManagerBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Projet\YdaysManagerBundle\Entity\Comment $comment
     */
    public function removeComment(\Projet\YdaysManagerBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set classroom
     *
     * @param string $classroom
     *
     * @return Project
     */
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get classroom
     *
     * @return string
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Project
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * Set entreprise
     *
     * @param \Projet\YdaysManagerBundle\Entity\Entreprise $entreprise
     *
     * @return Project
     */
    public function setEntreprise(\Projet\YdaysManagerBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \Projet\YdaysManagerBundle\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
}
