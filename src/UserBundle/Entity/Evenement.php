<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEvenement", type="string", length=255)
     */
    private $descriptionEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutEvenement", type="datetime")
     */
    private $dateDebutEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinEvenement", type="datetime")
     */
    private $dateFinEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="dureeEvenement", type="string", length=255)
     */
    private $dureeEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="etatEvenement", type="string", length=255)
     */
    private $etatEvenement;


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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     *
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set descriptionEvenement
     *
     * @param string $descriptionEvenement
     *
     * @return Evenement
     */
    public function setDescriptionEvenement($descriptionEvenement)
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    /**
     * Get descriptionEvenement
     *
     * @return string
     */
    public function getDescriptionEvenement()
    {
        return $this->descriptionEvenement;
    }

    /**
     * Set dateDebutEvenement
     *
     * @param string $dateDebutEvenement
     *
     * @return Evenement
     */
    public function setDateDebutEvenement($dateDebutEvenement)
    {
        $this->dateDebutEvenement = $dateDebutEvenement;

        return $this;
    }

    /**
     * Get dateDebutEvenement
     *
     * @return string
     */
    public function getDateDebutEvenement()
    {
        return $this->dateDebutEvenement;
    }

    /**
     * Set dateFinEvenement
     *
     * @param \DateTime $dateFinEvenement
     *
     * @return Evenement
     */
    public function setDateFinEvenement($dateFinEvenement)
    {
        $this->dateFinEvenement = $dateFinEvenement;

        return $this;
    }

    /**
     * Get dateFinEvenement
     *
     * @return \DateTime
     */
    public function getDateFinEvenement()
    {
        return $this->dateFinEvenement;
    }

    /**
     * Set dureeEvenement
     *
     * @param string $dureeEvenement
     *
     * @return Evenement
     */
    public function setDureeEvenement($dureeEvenement)
    {
        $this->dureeEvenement = $dureeEvenement;

        return $this;
    }

    /**
     * Get dureeEvenement
     *
     * @return string
     */
    public function getDureeEvenement()
    {
        return $this->dureeEvenement;
    }

    /**
     * Set etatEvenement
     *
     * @param string $etatEvenement
     *
     * @return Evenement
     */
    public function setEtatEvenement($etatEvenement)
    {
        $this->etatEvenement = $etatEvenement;

        return $this;
    }

    /**
     * Get etatEvenement
     *
     * @return string
     */
    public function getEtatEvenement()
    {
        return $this->etatEvenement;
    }
}

