<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePublication
 *
 * @ORM\Table(name="type_publication")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\TypePublicationRepository")
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
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomTypePublication", type="string", length=255)
     */
    public $nomTypePublication;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomTypePublication()
    {
        return $this->nomTypePublication;
    }

    /**
     * @param string $nomTypePublication
     */
    public function setNomTypePublication($nomTypePublication)
    {
        $this->nomTypePublication = $nomTypePublication;
    }



}

