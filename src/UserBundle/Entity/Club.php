<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ClubRepository")
 */
class Club
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
     * @ORM\Column(name="nomClub", type="string", length=255)
     */
    private $nomClub;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionClub", type="string", length=255)
     */
    private $descriptionClub;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationClub", type="datetime")
     */
    private $dateCreationClub;

    /**
     * @var string
     *
     * @ORM\Column(name="imageClub", type="string", length=255)
     */
    private $imageClub;


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
     * Set nomClub
     *
     * @param string $nomClub
     *
     * @return Club
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    /**
     * Get nomClub
     *
     * @return string
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * Set descriptionClub
     *
     * @param string $descriptionClub
     *
     * @return Club
     */
    public function setDescriptionClub($descriptionClub)
    {
        $this->descriptionClub = $descriptionClub;

        return $this;
    }

    /**
     * Get descriptionClub
     *
     * @return string
     */
    public function getDescriptionClub()
    {
        return $this->descriptionClub;
    }

    /**
     * Set dateCreationClub
     *
     * @param \DateTime $dateCreationClub
     *
     * @return Club
     */
    public function setDateCreationClub($dateCreationClub)
    {
        $this->dateCreationClub = $dateCreationClub;

        return $this;
    }

    /**
     * Get dateCreationClub
     *
     * @return \DateTime
     */
    public function getDateCreationClub()
    {
        return $this->dateCreationClub;
    }

    /**
     * Set imageClub
     *
     * @param string $imageClub
     *
     * @return Club
     */
    public function setImageClub($imageClub)
    {
        $this->imageClub = $imageClub;

        return $this;
    }

    /**
     * Get imageClub
     *
     * @return string
     */
    public function getImageClub()
    {
        return $this->imageClub;
    }
}

