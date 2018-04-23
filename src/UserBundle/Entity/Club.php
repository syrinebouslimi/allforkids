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
     * @ORM\Column(name="descriptionClub", type="string", length=4000)
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
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="idEtablissement",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idEtablissement;


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
     * @return string
     */
    public function getImageClub()
    {
        return $this->imageClub;
    }

    /**
     * @param string $imageClub
     */
    public function setImageClub($imageClub)
    {
        $this->imageClub = $imageClub;
    }


    /**
     * @return mixed
     */
    public function getIdEtablissement()
    {
        return $this->idEtablissement;
    }

    /**
     * @param mixed $idEtablissement
     */
    public function setIdEtablissement($idEtablissement)
    {
        $this->idEtablissement = $idEtablissement;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param mixed $long
     */
    public function setLong($long)
    {
        $this->long = $long;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     *
     * @ORM\Column(name="longi", type="float", nullable=true)
     */
    private $long;


    /**
     *
     * @ORM\Column(name="lat", type="float", nullable=true)
     */
    private $lat;



}
