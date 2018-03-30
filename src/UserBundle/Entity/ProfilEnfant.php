<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfilEnfant
 *
 * @ORM\Table(name="profil_enfant")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\ProfilEnfantRepository")
 */
class ProfilEnfant
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
     * @ORM\Column(name="prenomEnfant", type="string", length=255)
     */
    private $prenomEnfant;

    /**
     * @var int
     *
     * @ORM\Column(name="ageEnfant", type="integer")
     */
    private $ageEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="sexEnfant", type="string", length=255)
     */
    private $sexEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="photoEnfant", type="string", length=255)
     */
    private $photoEnfant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissanceEnfant", type="datetime")
     */
    private $datenaissanceEnfant;


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
     * @return ProfilEnfant
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
     * @return ProfilEnfant
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
     * @param integer $ageEnfant
     *
     * @return ProfilEnfant
     */
    public function setAgeEnfant($ageEnfant)
    {
        $this->ageEnfant = $ageEnfant;

        return $this;
    }

    /**
     * Get ageEnfant
     *
     * @return int
     */
    public function getAgeEnfant()
    {
        return $this->ageEnfant;
    }

    /**
     * Set sexEnfant
     *
     * @param string $sexEnfant
     *
     * @return ProfilEnfant
     */
    public function setSexEnfant($sexEnfant)
    {
        $this->sexEnfant = $sexEnfant;

        return $this;
    }

    /**
     * Get sexEnfant
     *
     * @return string
     */
    public function getSexEnfant()
    {
        return $this->sexEnfant;
    }

    /**
     * Set photoEnfant
     *
     * @param string $photoEnfant
     *
     * @return ProfilEnfant
     */
    public function setPhotoEnfant($photoEnfant)
    {
        $this->photoEnfant = $photoEnfant;

        return $this;
    }

    /**
     * Get photoEnfant
     *
     * @return string
     */
    public function getPhotoEnfant()
    {
        return $this->photoEnfant;
    }

    /**
     * Set datenaissanceEnfant
     *
     * @param \DateTime $datenaissanceEnfant
     *
     * @return ProfilEnfant
     */
    public function setDatenaissanceEnfant($datenaissanceEnfant)
    {
        $this->datenaissanceEnfant = $datenaissanceEnfant;

        return $this;
    }

    /**
     * Get datenaissanceEnfant
     *
     * @return \DateTime
     */
    public function getDatenaissanceEnfant()
    {
        return $this->datenaissanceEnfant;
    }
}

