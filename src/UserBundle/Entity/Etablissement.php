<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EtablissementRepository")
 */
class Etablissement
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
     * @var int
     *
     * @ORM\Column(name="rating", type="integer",nullable=true)
     */
    private $rating;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="integer",nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEtablissement", type="string", length=255)
     */
    private $nomEtablissement;

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @var text
     * @ORM\Column(name="descriptionEtablissement", type="text",length=256)
     */
    private $descriptionEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="cityEtablissement", type="string", length=255)
     */
    private $cityEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostalEtablissement", type="string", length=255)
     */
    private $codepostalEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="regionEtablissement", type="string", length=255)
     */
    private $regionEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="countryEtablissement", type="string", length=255)
     */
    private $countryEtablissement;

    /**
     * @var text
     *
     * @ORM\Column(name="exigenceEtablissement", type="text", length=255)
     */
    private $exigenceEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEtablissement", type="string", length=255)
     */
    private $typeEtablissement;

    /**
     * @return string
     */
    public function getTypeEtablissement()
    {
        return $this->typeEtablissement;
    }

    /**
     * @param string $typeEtablissement
     */
    public function setTypeEtablissement($typeEtablissement)
    {
        $this->typeEtablissement = $typeEtablissement;
    }


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationEtablissement", type="datetime",nullable=true)
     */
    private $dateCreationEtablissement;


    /**
     * @var string
     *
     * @ORM\Column(name="imageEtablissement", type="string", length=255,nullable=true)
     */
    private $imageEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="horaireEtablissement", type="string", length=255,nullable=true)
     */
    private $horaireEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseEtablissement", type="string", length=255)
     */
    private $adresseEtablissement;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserEtablissement",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserEtablissement;

    /**
     * @return mixed
     */
    public function getIdUserEtablissement()
    {
        return $this->idUserEtablissement;
    }

    /**
     * @param mixed $idUserEtablissement
     */
    public function setIdUserEtablissement($idUserEtablissement)
    {
        $this->idUserEtablissement = $idUserEtablissement;
    }


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
     * Set nomEtablissement
     *
     * @param string $nomEtablissement
     *
     * @return Etablissement
     */
    public function setNomEtablissement($nomEtablissement)
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    /**
     * Get nomEtablissement
     *
     * @return string
     */
    public function getNomEtablissement()
    {
        return $this->nomEtablissement;
    }

    /**
     * @return text
     */
    public function getDescriptionEtablissement()
    {
        return $this->descriptionEtablissement;
    }

    /**
     * @param text $descriptionEtablissement
     */
    public function setDescriptionEtablissement($descriptionEtablissement)
    {
        $this->descriptionEtablissement = $descriptionEtablissement;
    }



    /**
     * Set dateCreationEtablissement
     *
     * @param \DateTime $dateCreationEtablissement
     *
     * @return Etablissement
     */
    public function setDateCreationEtablissement($dateCreationEtablissement)
    {
        $this->dateCreationEtablissement = $dateCreationEtablissement;

        return $this;
    }

    /**
     * Get dateCreationEtablissement
     *
     * @return \DateTime
     */
    public function getDateCreationEtablissement()
    {
        return $this->dateCreationEtablissement;
    }

    /**
     * Set imageEtablissement
     *
     * @param string $imageEtablissement
     *
     * @return Etablissement
     */
    public function setImageEtablissement($imageEtablissement)
    {
        $this->imageEtablissement = $imageEtablissement;

        return $this;
    }

    /**
     * Get imageEtablissement
     *
     * @return string
     */
    public function getImageEtablissement()
    {
        return $this->imageEtablissement;
    }

    /**
     * Set horaireEtablissement
     *
     * @param string $horaireEtablissement
     *
     * @return Etablissement
     */
    public function setHoraireEtablissement($horaireEtablissement)
    {
        $this->horaireEtablissement = $horaireEtablissement;

        return $this;
    }

    /**
     * Get horaireEtablissement
     *
     * @return string
     */
    public function getHoraireEtablissement()
    {
        return $this->horaireEtablissement;
    }

    /**
     * @return string
     */
    public function getCityEtablissement()
    {
        return $this->cityEtablissement;
    }

    /**
     * @param string $cityEtablissement
     */
    public function setCityEtablissement($cityEtablissement)
    {
        $this->cityEtablissement = $cityEtablissement;
    }

    /**
     * @return string
     */
    public function getCodepostalEtablissement()
    {
        return $this->codepostalEtablissement;
    }

    /**
     * @param string $codepostalEtablissement
     */
    public function setCodepostalEtablissement($codepostalEtablissement)
    {
        $this->codepostalEtablissement = $codepostalEtablissement;
    }

    /**
     * @return string
     */
    public function getRegionEtablissement()
    {
        return $this->regionEtablissement;
    }

    /**
     * @param string $regionEtablissement
     */
    public function setRegionEtablissement($regionEtablissement)
    {
        $this->regionEtablissement = $regionEtablissement;
    }

    /**
     * @return string
     */
    public function getCountryEtablissement()
    {
        return $this->countryEtablissement;
    }

    /**
     * @param string $countryEtablissement
     */
    public function setCountryEtablissement($countryEtablissement)
    {
        $this->countryEtablissement = $countryEtablissement;
    }

    /**
     * @return text
     */
    public function getExigenceEtablissement()
    {
        return $this->exigenceEtablissement;
    }

    /**
     * @param text $exigenceEtablissement
     */
    public function setExigenceEtablissement($exigenceEtablissement)
    {
        $this->exigenceEtablissement = $exigenceEtablissement;
    }



    /**
     * @return string
     */
    public function getAdresseEtablissement()
    {
        return $this->adresseEtablissement;
    }

    /**
     * @param string $adresseEtablissement
     */
    public function setAdresseEtablissement($adresseEtablissement)
    {
        $this->adresseEtablissement = $adresseEtablissement;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function __construct()
    {
        $this->dateCreationEtablissement = new \DateTime();
    }



}

