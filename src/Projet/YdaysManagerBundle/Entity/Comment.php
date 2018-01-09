<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="text", type="string")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerUserBundle\Entity\User")
     * @ORM\JoinColumn(name="Author_Id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Project", inversedBy="comments")
     * @ORM\JoinColumn(name="Project_Id", referencedColumnName="id")
     */
    private $project;

  /**
     * @ORM\OneToMany(targetEntity="Projet\YdaysManagerBundle\Entity\AnswerComment", mappedBy="comment")
     */
    private $answers;
    
        public function __construct()
        {
            $this->answers = new ArrayCollection();
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
     * Set text
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set author
     *
     * @param \Projet\YdaysManagerUserBundle\Entity\User $author
     *
     * @return Comment
     */
    public function setAuthor(\Projet\YdaysManagerUserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Projet\YdaysManagerUserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     *
     * @return Comment
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
    
    /**
     * Add answer
     *
     * @param \Projet\YdaysManagerBundle\Entity\AnswerComment $answer
     *
     * @return Comment
     */
    public function addAnswer(\Projet\YdaysManagerBundle\Entity\AnswerComment $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \Projet\YdaysManagerBundle\Entity\AnswerComment $user
     */
    public function removeAnswer(\Projet\YdaysManagerBundle\Entity\AnswerComment $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return \Projet\YdaysManagerBundle\Entity\AnswerComment
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
