<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RendezVous
 *
 * @ORM\Table(name="rendez_vous")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\RendezVousRepository")
 */
class RendezVous
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateRendezVous", type="datetime")
     */
    private $dateRendezVous;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuRendezVous", type="string", length=255)
     */
    private $lieuRendezVous;


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
     * Set dateRendezVous
     *
     * @param \DateTime $dateRendezVous
     *
     * @return RendezVous
     */
    public function setDateRendezVous($dateRendezVous)
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    /**
     * Get dateRendezVous
     *
     * @return \DateTime
     */
    public function getDateRendezVous()
    {
        return $this->dateRendezVous;
    }

    /**
     * Set lieuRendezVous
     *
     * @param string $lieuRendezVous
     *
     * @return RendezVous
     */
    public function setLieuRendezVous($lieuRendezVous)
    {
        $this->lieuRendezVous = $lieuRendezVous;

        return $this;
    }

    /**
     * Get lieuRendezVous
     *
     * @return string
     */
    public function getLieuRendezVous()
    {
        return $this->lieuRendezVous;
    }
}

