<?php

namespace Projet\YdaysManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Projet\YdaysManagerBundle\Entity\Project;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="Projet\YdaysManagerBundle\Repository\EntrepriseRepository")
 */
class Entreprise
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
     * @ORM\Column(name="nom_entreprise", type="string", length=191, unique=true,nullable=true)
     */
    private $nomEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_entreprise", type="string", length=191,nullable=true)
     */
    private $adresseEntreprise;

    /**
     * @var int
     *
     * @ORM\Column(name="cp_entreprise", type="integer",nullable=true)
     */
    private $cpEntreprise;

    /**
     * @var int
     *
     * @ORM\Column(name="siret_entreprise", type="string",length=191, unique=true,nullable=true)
     */
    private $siretEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="img_entreprise", type="string", length=191,nullable=true)
     */
    private $imgEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_entreprise", type="string", length=191,nullable=true)
     */
    private $villeEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="info_entreprise", type="string", length=165,nullable=true)
     */
    private $infoEntreprise;

    /**
     * @ORM\OneToMany(targetEntity="Projet\YdaysManagerBundle\Entity\Project", mappedBy="entreprise")
     */
    private $projects;




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
     * Set nomEntreprise
     *
     * @param string $nomEntreprise
     *
     * @return entreprise
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * Get nomEntreprise
     *
     * @return string
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set adresseEntreprise
     *
     * @param string $adresseEntreprise
     *
     * @return entreprise
     */
    public function setAdresseEntreprise($adresseEntreprise)
    {
        $this->adresseEntreprise = $adresseEntreprise;

        return $this;
    }

    /**
     * Get adresseEntreprise
     *
     * @return string
     */
    public function getAdresseEntreprise()
    {
        return $this->adresseEntreprise;
    }

    /**
     * Set cpEntreprise
     *
     * @param integer $cpEntreprise
     *
     * @return entreprise
     */
    public function setCpEntreprise($cpEntreprise)
    {
        $this->cpEntreprise = $cpEntreprise;

        return $this;
    }

    /**
     * Get cpEntreprise
     *
     * @return int
     */
    public function getCpEntreprise()
    {
        return $this->cpEntreprise;
    }

    /**
     * Set siretEntreprise
     *
     * @param string $siretEntreprise
     *
     * @return entreprise
     */
    public function setSiretEntreprise($siretEntreprise)
    {
        $this->siretEntreprise = $siretEntreprise;

        return $this;
    }

    /**
     * Get siretEntreprise
     *
     * @return string
     */
    public function getSiretEntreprise()
    {
        return $this->siretEntreprise;
    }

    /**
     * Set imgEntreprise
     *
     * @param string $imgEntreprise
     *
     * @return entreprise
     */
    public function setImgEntreprise($imgEntreprise)
    {
        $this->imgEntreprise = $imgEntreprise;

        return $this;
    }

    /**
     * Get imgEntreprise
     *
     * @return string
     */
    public function getImgEntreprise()
    {
        return $this->imgEntreprise;
    }

    /**
     * Set villeEntreprise
     *
     * @param string $villeEntreprise
     *
     * @return entreprise
     */
    public function setVilleEntreprise($villeEntreprise)
    {
        $this->villeEntreprise = $villeEntreprise;

        return $this;
    }

    /**
     * Get villeEntreprise
     *
     * @return string
     */
    public function getVilleEntreprise()
    {
        return $this->villeEntreprise;
    }


    /**
     * Set infoEntreprise
     *
     * @param string $infoEntreprise
     *
     * @return entreprise
     */
    public function setInfoEntreprise($infoEntreprise)
    {
        $this->infoEntreprise = $infoEntreprise;

        return $this;
    }

    /**
     * Get infoEntreprise
     *
     * @return string
     */
    public function getInfoEntreprise()
    {
        return $this->infoEntreprise;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return (string) $this->nomEntreprise; }

    /**
     * Add project
     *
     * @param \Projet\YdaysManagerBundle\Entity\Project $project
     *
     * @return Entreprise
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
