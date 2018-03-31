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
     * @var string
     *
     * @ORM\Column(name="nomEtablissement", type="string", length=255)
     */
    private $nomEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEtablissement", type="string", length=255)
     */
    private $descriptionEtablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationEtablissement", type="datetime")
     */
    private $dateCreationEtablissement;


    /**
     * @var string
     *
     * @ORM\Column(name="imageEtablissement", type="string", length=255)
     */
    private $imageEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="horaireEtablissement", type="string", length=255)
     */
    private $horaireEtablissement;


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
     * Set descriptionEtablissement
     *
     * @param string $descriptionEtablissement
     *
     * @return Etablissement
     */
    public function setDescriptionEtablissement($descriptionEtablissement)
    {
        $this->descriptionEtablissement = $descriptionEtablissement;

        return $this;
    }

    /**
     * Get descriptionEtablissement
     *
     * @return string
     */
    public function getDescriptionEtablissement()
    {
        return $this->descriptionEtablissement;
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
}

