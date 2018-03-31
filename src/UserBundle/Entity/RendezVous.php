<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RendezVous
 *
 * @ORM\Table(name="rendez_vous")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\RendezVousRepository")
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
 *
 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
 * @ORM\JoinColumn(name="idUserRendezVous",referencedColumnName="id",onDelete="CASCADE")
 */

    private $idUserRendezVous;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Service")
     * @ORM\JoinColumn(name="idServiceRendezVous",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idServiceRendezVous;




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

    /**
     * @return mixed
     */
    public function getIdUserRendezVous()
    {
        return $this->idUserRendezVous;
    }

    /**
     * @param mixed $idUserRendezVous
     */
    public function setIdUserRendezVous($idUserRendezVous)
    {
        $this->idUserRendezVous = $idUserRendezVous;
    }

    /**
     * @return mixed
     */
    public function getIdServiceRendezVous()
    {
        return $this->idServiceRendezVous;
    }

    /**
     * @param mixed $idServiceRendezVous
     */
    public function setIdServiceRendezVous($idServiceRendezVous)
    {
        $this->idServiceRendezVous = $idServiceRendezVous;
    }




}

