<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="nomService", type="string", length=255)
     */
    private $nomService;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuService", type="string", length=255)
     */
    private $contenuService;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionService", type="string", length=255)
     */
    private $descriptionService;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseService", type="string", length=255)
     */
    private $adresseService;

    /**
     * @var string
     *
     * @ORM\Column(name="prixService", type="string", length=255)
     */
    private $prixService;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateService", type="datetime")
     */
    private $dateService;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserService",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserService;
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\TypeService")
     * @ORM\JoinColumn(name="idTypeService",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idTypeService;

    /**
     * @return mixed
     */
    public function getIdUserService()
    {
        return $this->idUserService;
    }

    /**
     * @param mixed $idUserService
     */
    public function setIdUserService($idUserService)
    {
        $this->idUserService = $idUserService;
    }

    /**
     * @return mixed
     */
    public function getIdTypeService()
    {
        return $this->idTypeService;
    }

    /**
     * @param mixed $idTypeService
     */
    public function setIdTypeService($idTypeService)
    {
        $this->idTypeService = $idTypeService;
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
     * Set nomService
     *
     * @param string $nomService
     *
     * @return Service
     */
    public function setNomService($nomService)
    {
        $this->nomService = $nomService;

        return $this;
    }

    /**
     * Get nomService
     *
     * @return string
     */
    public function getNomService()
    {
        return $this->nomService;
    }

    /**
     * Set contenuService
     *
     * @param string $contenuService
     *
     * @return Service
     */
    public function setContenuService($contenuService)
    {
        $this->contenuService = $contenuService;

        return $this;
    }

    /**
     * Get contenuService
     *
     * @return string
     */
    public function getContenuService()
    {
        return $this->contenuService;
    }

    /**
     * Set descriptionService
     *
     * @param string $descriptionService
     *
     * @return Service
     */
    public function setDescriptionService($descriptionService)
    {
        $this->descriptionService = $descriptionService;

        return $this;
    }

    /**
     * Get descriptionService
     *
     * @return string
     */
    public function getDescriptionService()
    {
        return $this->descriptionService;
    }

    /**
     * Set adresseService
     *
     * @param string $adresseService
     *
     * @return Service
     */
    public function setAdresseService($adresseService)
    {
        $this->adresseService = $adresseService;

        return $this;
    }

    /**
     * Get adresseService
     *
     * @return string
     */
    public function getAdresseService()
    {
        return $this->adresseService;
    }

    /**
     * Set prixService
     *
     * @param string $prixService
     *
     * @return Service
     */
    public function setPrixService($prixService)
    {
        $this->prixService = $prixService;

        return $this;
    }

    /**
     * Get prixService
     *
     * @return string
     */
    public function getPrixService()
    {
        return $this->prixService;
    }

    /**
     * Set dateService
     *
     * @param \DateTime $dateService
     *
     * @return Service
     */
    public function setDateService($dateService)
    {
        $this->dateService = $dateService;

        return $this;
    }

    /**
     * Get dateService
     *
     * @return \DateTime
     */
    public function getDateService()
    {
        return $this->dateService;
    }

}

