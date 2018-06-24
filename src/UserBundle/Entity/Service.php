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
     * @ORM\Column(name="nomService", type="string", length=255,nullable=true)
     */
    private $nomService;


    /**
     * @var string
     *
     * @ORM\Column(name="descriptionService", type="string", length=255,nullable=true)
     */
    private $descriptionService;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseService", type="string", length=255,nullable=true)
     */
    private $adresseService;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateService", type="datetime",nullable=true)
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
     * @var String
     *
     * @ORM\Column(name="contact", type="string",nullable=true)
     */
    private $contact;

    /**
     * @return String
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param String $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
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
     * @var string
     *
     * @ORM\Column(name="imagServ", type="string",nullable=true)
     */
    private $imagServ;

    /**
     * @return string
     */
    public function getImagServ()
    {
        return $this->imagServ;
    }

    /**
     * @param string $imagServ
     */
    public function setImagServ($imagServ)
    {
        $this->imagServ = $imagServ;
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

