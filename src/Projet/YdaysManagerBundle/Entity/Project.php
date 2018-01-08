<?php

namespace Projet\YdaysManagerBundle\Entity;

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
     * @ORM\Column(name="Nom_projet", type="string", length=255)
     */
    private $nomProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="Composition_groupe", type="string", length=999, nullable=true)
     */
    private $compositionGroupe;

    /**
     * @var int
     *
     * @ORM\Column(name="Type_projet", type="integer", nullable=true)
     */
    private $typeProjet;

    /**
     * @var int
     *
     * @ORM\Column(name="Chef_projet", type="integer", nullable=true)
     */
    private $chefProjet;

    /**
     * @var bool
     *
     * @ORM\Column(name="Ydays_perso", type="boolean")
     */
    private $ydaysPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="Referent_projet", type="integer", nullable=true)
     */
    private $referentProjet;

    /**
    * @var int
    * @ORM\ManyToOne(targetEntity="Projet\YdaysManagerBundle\Entity\Entreprise")
    * @ORM\JoinColumn(nullable=false)
    */
    private $entreprise;


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
     * Set nomProjet
     *
     * @param string $nomProjet
     *
     * @return Project
     */
    public function setNomProjet($nomProjet)
    {
        $this->nomProjet = $nomProjet;

        return $this;
    }

    /**
     * Get nomProjet
     *
     * @return string
     */
    public function getNomProjet()
    {
        return $this->nomProjet;
    }

    /**
     * Set compositionGroupe
     *
     * @param string $compositionGroupe
     *
     * @return Project
     */
    public function setCompositionGroupe($compositionGroupe)
    {
        $this->compositionGroupe = $compositionGroupe;

        return $this;
    }

    /**
     * Get compositionGroupe
     *
     * @return string
     */
    public function getCompositionGroupe()
    {
        return $this->compositionGroupe;
    }

    /**
     * Set typeProjet
     *
     * @param integer $typeProjet
     *
     * @return Project
     */
    public function setTypeProjet($typeProjet)
    {
        $this->typeProjet = $typeProjet;

        return $this;
    }

    /**
     * Get typeProjet
     *
     * @return int
     */
    public function getTypeProjet()
    {
        return $this->typeProjet;
    }

    /**
     * Set chefProjet
     *
     * @param integer $chefProjet
     *
     * @return Project
     */
    public function setChefProjet($chefProjet)
    {
        $this->chefProjet = $chefProjet;

        return $this;
    }

    /**
     * Get chefProjet
     *
     * @return int
     */
    public function getChefProjet()
    {
        return $this->chefProjet;
    }

    /**
     * Set ydaysPerso
     *
     * @param boolean $ydaysPerso
     *
     * @return Project
     */
    public function setYdaysPerso($ydaysPerso)
    {
        $this->ydaysPerso = $ydaysPerso;

        return $this;
    }

    /**
     * Get ydaysPerso
     *
     * @return bool
     */
    public function getYdaysPerso()
    {
        return $this->ydaysPerso;
    }

    /**
     * Set referentProjet
     *
     * @param integer $referentProjet
     *
     * @return Project
     */
    public function setReferentProjet($referentProjet)
    {
        $this->referentProjet = $referentProjet;

        return $this;
    }

    /**
     * Get referentProjet
     *
     * @return int
     */
    public function getReferentProjet()
    {
        return $this->referentProjet;
    }

    /**
     * Set entreprise
     *
     * @param \Projet\YdaysManagerBundle\Entity\Entreprise $entreprise
     *
     * @return Project
     */
    public function setEntreprise(\Projet\YdaysManagerBundle\Entity\Entreprise $entreprise)
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
