<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeService
 *
 * @ORM\Table(name="type_service")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\TypeServiceRepository")
 */
class TypeService
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
     * @ORM\Column(name="nomTypeService", type="string", length=255)
     */
    private $nomTypeService;


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
     * Set nomTypeService
     *
     * @param string $nomTypeService
     *
     * @return TypeService
     */
    public function setNomTypeService($nomTypeService)
    {
        $this->nomTypeService = $nomTypeService;

        return $this;
    }

    /**
     * Get nomTypeService
     *
     * @return string
     */
    public function getNomTypeService()
    {
        return $this->nomTypeService;
    }
}

