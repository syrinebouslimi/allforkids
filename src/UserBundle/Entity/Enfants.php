<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enfants
 *
 * @ORM\Table(name="enfants")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EnfantsRepository")
 */
class Enfants
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
     * @ORM\Column(name="nomEnfant", type="string", length=255)
     */
    private $nomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="PrenomEnfant", type="string", length=255)
     */
    private $prenomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="AgeEnfant", type="string", length=255)
     */
    private $ageEnfant;

    /**
     * @return mixed
     */
    public function getIdUserParents()
    {
        return $this->idUserParents;
    }

    /**
     * @param mixed $idUserParents
     */
    public function setIdUserParents($idUserParents)
    {
        $this->idUserParents = $idUserParents;
    }

    /**
     * @return mixed
     */
    public function getIdUserParent()
    {
        return $this->idUserParent;
    }

    /**
     * @param mixed $idUserParent
     */
    public function setIdUserParent($idUserParent)
    {
        $this->idUserParent = $idUserParent;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserParent",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserParent;

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
     * Set nomEnfant
     *
     * @param string $nomEnfant
     *
     * @return Enfants
     */
    public function setNomEnfant($nomEnfant)
    {
        $this->nomEnfant = $nomEnfant;

        return $this;
    }

    /**
     * Get nomEnfant
     *
     * @return string
     */
    public function getNomEnfant()
    {
        return $this->nomEnfant;
    }

    /**
     * Set prenomEnfant
     *
     * @param string $prenomEnfant
     *
     * @return Enfants
     */
    public function setPrenomEnfant($prenomEnfant)
    {
        $this->prenomEnfant = $prenomEnfant;

        return $this;
    }

    /**
     * Get prenomEnfant
     *
     * @return string
     */
    public function getPrenomEnfant()
    {
        return $this->prenomEnfant;
    }

    /**
     * Set ageEnfant
     *
     * @param string $ageEnfant
     *
     * @return Enfants
     */
    public function setAgeEnfant($ageEnfant)
    {
        $this->ageEnfant = $ageEnfant;

        return $this;
    }

    /**
     * Get ageEnfant
     *
     * @return string
     */
    public function getAgeEnfant()
    {
        return $this->ageEnfant;
    }
}

