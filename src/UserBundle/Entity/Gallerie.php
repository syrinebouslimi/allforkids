<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallerie
 *
 * @ORM\Table(name="gallerie")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\GallerieRepository")
 */
class Gallerie
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
     * @ORM\Column(name="imageGallery", type="string", length=255)
     */
    public $imageGallery;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionImageGallery", type="string", length=255)
     */
    public $descriptionImageGallery;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="etablissementId",referencedColumnName="id",onDelete="CASCADE")
     */
    public $etablissementId;


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
     * Set imageGallery
     *
     * @param string $imageGallery
     *
     * @return Gallerie
     */
    public function setImageGallery($imageGallery)
    {
        $this->imageGallery = $imageGallery;

        return $this;
    }

    /**
     * Get imageGallery
     *
     * @return string
     */
    public function getImageGallery()
    {
        return $this->imageGallery;
    }

    /**
     * Set descriptionImageGallery
     *
     * @param string $descriptionImageGallery
     *
     * @return Gallerie
     */
    public function setDescriptionImageGallery($descriptionImageGallery)
    {
        $this->descriptionImageGallery = $descriptionImageGallery;

        return $this;
    }

    /**
     * Get descriptionImageGallery
     *
     * @return string
     */
    public function getDescriptionImageGallery()
    {
        return $this->descriptionImageGallery;
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

