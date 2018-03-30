<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriePublication
 *
 * @ORM\Table(name="categorie_publication")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\CategoriePublicationRepository")
 */
class CategoriePublication
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
     * @ORM\Column(name="nomCategPublication", type="string", length=255)
     */
    private $nomCategPublication;


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
     * Set nomCategPublication
     *
     * @param string $nomCategPublication
     *
     * @return CategoriePublication
     */
    public function setNomCategPublication($nomCategPublication)
    {
        $this->nomCategPublication = $nomCategPublication;

        return $this;
    }

    /**
     * Get nomCategPublication
     *
     * @return string
     */
    public function getNomCategPublication()
    {
        return $this->nomCategPublication;
    }
}

