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
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserPublication",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserPublication;




    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\TypePublication")
     * @ORM\JoinColumn(name="typePublication",referencedColumnName="id",onDelete="CASCADE")
     */

    private $typePublication;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\CategoriePublication")
     * @ORM\JoinColumn(name="categoriePublication",referencedColumnName="id",onDelete="CASCADE")
     */

    private $categoriePublication;



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
     * @var string
     *
     * @ORM\Column(name="etatPublication", type="string", length=255)
     */
    private $etatPublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @var text
     *
     * @ORM\Column(name="descriptionPublication", type="text")
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
     * @return text
     */
    public function getDescriptionPublication()
    {
        return $this->descriptionPublication;
    }

    /**
     * @param text $descriptionPublication
     */
    public function setDescriptionPublication($descriptionPublication)
    {
        $this->descriptionPublication = $descriptionPublication;
    }



    /**
     * @return mixed
     */
    public function getIdUserPublication()
    {
        return $this->idUserPublication;
    }

    /**
     * @param mixed $idUserPublication
     */
    public function setIdUserPublication($idUserPublication)
    {
        $this->idUserPublication = $idUserPublication;
    }

    /**
     * @return string
     */
    public function getEtatPublication()
    {
        return $this->etatPublication;
    }

    /**
     * @param string $etatPublication
     */
    public function setEtatPublication($etatPublication)
    {
        $this->etatPublication = $etatPublication;
    }

    /**
     * @return mixed
     */
    public function getTypePublication()
    {
        return $this->typePublication;
    }

    /**
     * @param mixed $typePublication
     */
    public function setTypePublication($typePublication)
    {
        $this->typePublication = $typePublication;
    }

    /**
     * @return mixed
     */
    public function getCategoriePublication()
    {
        return $this->categoriePublication;
    }

    /**
     * @param mixed $categoriePublication
     */
    public function setCategoriePublication($categoriePublication)
    {
        $this->categoriePublication = $categoriePublication;
    }







}

