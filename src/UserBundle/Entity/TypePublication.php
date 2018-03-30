<?php

namespace UsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePublication
 *
 * @ORM\Table(name="type_publication")
 * @ORM\Entity(repositoryClass="UsersBundle\Repository\TypePublicationRepository")
 */
class TypePublication
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
     * @ORM\Column(name="nomTypePublication", type="string", length=255)
     */
    private $nomTypePublication;


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
     * Set nomTypePublication
     *
     * @param string $nomTypePublication
     *
     * @return TypePublication
     */
    public function setNomTypePublication($nomTypePublication)
    {
        $this->nomTypePublication = $nomTypePublication;

        return $this;
    }

    /**
     * Get nomTypePublication
     *
     * @return string
     */
    public function getNomTypePublication()
    {
        return $this->nomTypePublication;
    }
}

