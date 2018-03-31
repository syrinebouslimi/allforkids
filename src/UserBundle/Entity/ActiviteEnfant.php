<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActiviteEnfant
 *
 * @ORM\Table(name="activite_enfant")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ActiviteEnfantRepository")
 */
class ActiviteEnfant
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
     * @ORM\Column(name="nomActivite", type="string", length=255)
     */
    private $nomActivite;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\ProfilEnfant")
     * @ORM\JoinColumn(name="idProfileEnfant",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idProfileEnfant;


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
     * Set nomActivite
     *
     * @param string $nomActivite
     *
     * @return ActiviteEnfant
     */
    public function setNomActivite($nomActivite)
    {
        $this->nomActivite = $nomActivite;

        return $this;
    }

    /**
     * Get nomActivite
     *
     * @return string
     */
    public function getNomActivite()
    {
        return $this->nomActivite;
    }

    /**
     * @return mixed
     */
    public function getIdProfileEnfant()
    {
        return $this->idProfileEnfant;
    }

    /**
     * @param mixed $idProfileEnfant
     */
    public function setIdProfileEnfant($idProfileEnfant)
    {
        $this->idProfileEnfant = $idProfileEnfant;
    }

}

