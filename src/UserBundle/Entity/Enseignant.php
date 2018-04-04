<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseignant
 *
 * @ORM\Table(name="enseignant")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EnseignantRepository")
 */
class Enseignant
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
     * @ORM\Column(name="nomEnseignant", type="string", length=255)
     */
    private $nomEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomEnseignant", type="string", length=255)
     */
    private $prenomEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseEnseignant", type="string", length=255)
     */
    private $adresseEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostalEnseignant", type="string", length=255)
     */
    private $codePostalEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="countryEnseignant", type="string", length=255)
     */
    private $countryEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="regionEnseignant", type="string", length=255)
     */
    private $regionEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="imageEnseignant", type="string", length=255)
     */
    private $imageEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="aboutEnseignant", type="string", length=255)
     */
    private $aboutEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="designationEnseignant", type="string", length=255)
     */
    private $designationEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="diplomeEnseignant", type="string", length=255)
     */
    private $diplomeEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="experienceEnseignant", type="string", length=255)
     */
    private $experienceEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="hobbiesEnseignant", type="string", length=255)
     */
    private $hobbiesEnseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="coursEnseignant", type="string", length=255)
     */
    private $coursEnseignant;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="etablissementId",referencedColumnName="id",onDelete="CASCADE")
     */
    private $etablissementId;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Set nomEnseignant
     *
     * @param string $nomEnseignant
     *
     * @return Enseignant
     */
    public function setNomEnseignant($nomEnseignant)
    {
        $this->nomEnseignant = $nomEnseignant;

        return $this;
    }

    /**
     * Get nomEnseignant
     *
     * @return string
     */
    public function getNomEnseignant()
    {
        return $this->nomEnseignant;
    }

    /**
     * Set prenomEnseignant
     *
     * @param string $prenomEnseignant
     *
     * @return Enseignant
     */
    public function setPrenomEnseignant($prenomEnseignant)
    {
        $this->prenomEnseignant = $prenomEnseignant;

        return $this;
    }

    /**
     * Get prenomEnseignant
     *
     * @return string
     */
    public function getPrenomEnseignant()
    {
        return $this->prenomEnseignant;
    }

    /**
     * Set adresseEnseignant
     *
     * @param string $adresseEnseignant
     *
     * @return Enseignant
     */
    public function setAdresseEnseignant($adresseEnseignant)
    {
        $this->adresseEnseignant = $adresseEnseignant;

        return $this;
    }

    /**
     * Get adresseEnseignant
     *
     * @return string
     */
    public function getAdresseEnseignant()
    {
        return $this->adresseEnseignant;
    }

    /**
     * Set codePostalEnseignant
     *
     * @param string $codePostalEnseignant
     *
     * @return Enseignant
     */
    public function setCodePostalEnseignant($codePostalEnseignant)
    {
        $this->codePostalEnseignant = $codePostalEnseignant;

        return $this;
    }

    /**
     * Get codePostalEnseignant
     *
     * @return string
     */
    public function getCodePostalEnseignant()
    {
        return $this->codePostalEnseignant;
    }

    /**
     * Set countryEnseignant
     *
     * @param string $countryEnseignant
     *
     * @return Enseignant
     */
    public function setCountryEnseignant($countryEnseignant)
    {
        $this->countryEnseignant = $countryEnseignant;

        return $this;
    }

    /**
     * Get countryEnseignant
     *
     * @return string
     */
    public function getCountryEnseignant()
    {
        return $this->countryEnseignant;
    }

    /**
     * Set regionEnseignant
     *
     * @param string $regionEnseignant
     *
     * @return Enseignant
     */
    public function setRegionEnseignant($regionEnseignant)
    {
        $this->regionEnseignant = $regionEnseignant;

        return $this;
    }

    /**
     * Get regionEnseignant
     *
     * @return string
     */
    public function getRegionEnseignant()
    {
        return $this->regionEnseignant;
    }

    /**
     * Set imageEnseignant
     *
     * @param string $imageEnseignant
     *
     * @return Enseignant
     */
    public function setImageEnseignant($imageEnseignant)
    {
        $this->imageEnseignant = $imageEnseignant;

        return $this;
    }

    /**
     * Get imageEnseignant
     *
     * @return string
     */
    public function getImageEnseignant()
    {
        return $this->imageEnseignant;
    }

    /**
     * Set aboutEnseignant
     *
     * @param string $aboutEnseignant
     *
     * @return Enseignant
     */
    public function setAboutEnseignant($aboutEnseignant)
    {
        $this->aboutEnseignant = $aboutEnseignant;

        return $this;
    }

    /**
     * Get aboutEnseignant
     *
     * @return string
     */
    public function getAboutEnseignant()
    {
        return $this->aboutEnseignant;
    }

    /**
     * Set designationEnseignant
     *
     * @param string $designationEnseignant
     *
     * @return Enseignant
     */
    public function setDesignationEnseignant($designationEnseignant)
    {
        $this->designationEnseignant = $designationEnseignant;

        return $this;
    }

    /**
     * Get designationEnseignant
     *
     * @return string
     */
    public function getDesignationEnseignant()
    {
        return $this->designationEnseignant;
    }

    /**
     * Set diplomeEnseignant
     *
     * @param string $diplomeEnseignant
     *
     * @return Enseignant
     */
    public function setDiplomeEnseignant($diplomeEnseignant)
    {
        $this->diplomeEnseignant = $diplomeEnseignant;

        return $this;
    }

    /**
     * Get diplomeEnseignant
     *
     * @return string
     */
    public function getDiplomeEnseignant()
    {
        return $this->diplomeEnseignant;
    }

    /**
     * Set experienceEnseignant
     *
     * @param string $experienceEnseignant
     *
     * @return Enseignant
     */
    public function setExperienceEnseignant($experienceEnseignant)
    {
        $this->experienceEnseignant = $experienceEnseignant;

        return $this;
    }

    /**
     * Get experienceEnseignant
     *
     * @return string
     */
    public function getExperienceEnseignant()
    {
        return $this->experienceEnseignant;
    }

    /**
     * Set hobbiesEnseignant
     *
     * @param string $hobbiesEnseignant
     *
     * @return Enseignant
     */
    public function setHobbiesEnseignant($hobbiesEnseignant)
    {
        $this->hobbiesEnseignant = $hobbiesEnseignant;

        return $this;
    }

    /**
     * Get hobbiesEnseignant
     *
     * @return string
     */
    public function getHobbiesEnseignant()
    {
        return $this->hobbiesEnseignant;
    }

    /**
     * Set coursEnseignant
     *
     * @param string $coursEnseignant
     *
     * @return Enseignant
     */
    public function setCoursEnseignant($coursEnseignant)
    {
        $this->coursEnseignant = $coursEnseignant;

        return $this;
    }

    /**
     * Get coursEnseignant
     *
     * @return string
     */
    public function getCoursEnseignant()
    {
        return $this->coursEnseignant;
    }

    /**
     * @return mixed
     */
    public function getEtablissementId()
    {
        return $this->etablissementId;
    }

    /**
     * @param mixed $etablissementId
     */
    public function setEtablissementId($etablissementId)
    {
        $this->etablissementId = $etablissementId;
    }


}

