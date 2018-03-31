<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @ORM\Column(name="nomReclamation", type="string", length=255)
     */
    private $nomReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionReclamation", type="string", length=255)
     */
    private $descriptionReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuReclamation", type="string", length=255)
     */
    private $contenuReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="emetteurReclamation", type="string", length=255)
     */
    private $emetteurReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="recepteurReclamation", type="string", length=255)
     */
    private $recepteurReclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReclamation", type="datetime")
     */
    private $dateReclamation;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserReclamation",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserReclamation;


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
     * Set nomReclamation
     *
     * @param string $nomReclamation
     *
     * @return Reclamation
     */
    public function setNomReclamation($nomReclamation)
    {
        $this->nomReclamation = $nomReclamation;

        return $this;
    }

    /**
     * Get nomReclamation
     *
     * @return string
     */
    public function getNomReclamation()
    {
        return $this->nomReclamation;
    }

    /**
     * Set descriptionReclamation
     *
     * @param string $descriptionReclamation
     *
     * @return Reclamation
     */
    public function setDescriptionReclamation($descriptionReclamation)
    {
        $this->descriptionReclamation = $descriptionReclamation;

        return $this;
    }

    /**
     * Get descriptionReclamation
     *
     * @return string
     */
    public function getDescriptionReclamation()
    {
        return $this->descriptionReclamation;
    }

    /**
     * Set contenuReclamation
     *
     * @param string $contenuReclamation
     *
     * @return Reclamation
     */
    public function setContenuReclamation($contenuReclamation)
    {
        $this->contenuReclamation = $contenuReclamation;

        return $this;
    }

    /**
     * Get contenuReclamation
     *
     * @return string
     */
    public function getContenuReclamation()
    {
        return $this->contenuReclamation;
    }

    /**
     * Set dateReclamation
     *
     * @param \DateTime $dateReclamation
     *
     * @return Reclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;

        return $this;
    }

    /**
     * Get dateReclamation
     *
     * @return \DateTime
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * @return string
     */
    public function getEmetteurReclamation()
    {
        return $this->emetteurReclamation;
    }

    /**
     * @param string $emetteurReclamation
     */
    public function setEmetteurReclamation($emetteurReclamation)
    {
        $this->emetteurReclamation = $emetteurReclamation;
    }

    /**
     * @return string
     */
    public function getRecepteurReclamation()
    {
        return $this->recepteurReclamation;
    }

    /**
     * @param string $recepteurReclamation
     */
    public function setRecepteurReclamation($recepteurReclamation)
    {
        $this->recepteurReclamation = $recepteurReclamation;
    }

    /**
     * @return mixed
     */
    public function getIdUserReclamation()
    {
        return $this->idUserReclamation;
    }

    /**
     * @param mixed $idUserReclamation
     */
    public function setIdUserReclamation($idUserReclamation)
    {
        $this->idUserReclamation = $idUserReclamation;
    }




}

