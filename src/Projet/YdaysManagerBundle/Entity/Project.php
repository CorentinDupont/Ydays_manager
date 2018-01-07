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
     * @ORM\Column(name="Name", type="string", length=191)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Projet\YdaysManagerUserBundle\Entity\User")
     */
    private $members;

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
}
