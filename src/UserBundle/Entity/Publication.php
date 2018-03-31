<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="nomPublication", type="string", length=255, nullable=true)
     */
    private $nomPublication;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuPublication", type="string", length=255)
     */
    private $contenuPublication;

    /**
     * @var string
     *
     * @ORM\Column(name="imagePublication", type="string", length=255)
     */
    private $imagePublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionPublication", type="string", length=255)
     */
    private $descriptionPublication;


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
     * Set nomPublication
     *
     * @param string $nomPublication
     *
     * @return Publication
     */
    public function setNomPublication($nomPublication)
    {
        $this->nomPublication = $nomPublication;

        return $this;
    }

    /**
     * Get nomPublication
     *
     * @return string
     */
    public function getNomPublication()
    {
        return $this->nomPublication;
    }

    /**
     * Set contenuPublication
     *
     * @param string $contenuPublication
     *
     * @return Publication
     */
    public function setContenuPublication($contenuPublication)
    {
        $this->contenuPublication = $contenuPublication;

        return $this;
    }

    /**
     * Get contenuPublication
     *
     * @return string
     */
    public function getContenuPublication()
    {
        return $this->contenuPublication;
    }

    /**
     * Set imagePublication
     *
     * @param string $imagePublication
     *
     * @return Publication
     */
    public function setImagePublication($imagePublication)
    {
        $this->imagePublication = $imagePublication;

        return $this;
    }

    /**
     * Get imagePublication
     *
     * @return string
     */
    public function getImagePublication()
    {
        return $this->imagePublication;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Publication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @return string
     */
    public function getDescriptionPublication()
    {
        return $this->descriptionPublication;
    }

    /**
     * @param string $descriptionPublication
     */
    public function setDescriptionPublication($descriptionPublication)
    {
        $this->descriptionPublication = $descriptionPublication;
    }


}

