<?php

namespace Projet\YdaysManagerUserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerUserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=999, nullable=true)
     */
    public $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=999, nullable=true)
     */
    public $imageName;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Promotion", inversedBy="users")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id")
     */
    public $promotion;

    /**
     * @ORM\ManyToMany(targetEntity="Projet\YdaysManagerBundle\Entity\Project")
     * @ORM\JoinTable(name="user_project")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="Projet\YdaysManagerBundle\Entity\Desire", mappedBy="requester")
     */
    private $desires;



    public function __construct()
    {
        parent::__construct();
        $this->projects = new ArrayCollection();
        $this->desires = new ArrayCollection();
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return User
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
     * Set promotion
     *
     * @param \Projet\YdaysManagerBundle\Entity\Promotion $promotion
     *
     * @return User
     */
    public function setPromotion(\Projet\YdaysManagerBundle\Entity\Promotion $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return \Projet\YdaysManagerBundle\Entity\Promotion
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Add project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     *
     * @return User
     */
    public function addProject(\Projet\YdaysManagerBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     */
    public function removeProject(\Projet\YdaysManagerBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
