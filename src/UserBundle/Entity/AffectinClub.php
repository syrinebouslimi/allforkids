<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffectinClub
 *
 * @ORM\Table(name="affectinclub")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AffectinClubRepository")
 */
class AffectinClub
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Club")
     * @ORM\JoinColumn(name="idClub",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idClub;

    /**
     * @return mixed
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * @param mixed $idClub
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return mixed
     */
    public function getIdUserParent()
    {
        return $this->idUserParent;
    }

    /**
     * @param mixed $idUserParent
     */
    public function setIdUserParent($idUserParent)
    {
        $this->idUserParent = $idUserParent;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserParent",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idUserParent;

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
     * @return mixed
     */
    public function getIdEnfant()
    {
        return $this->idEnfant;
    }

    /**
     * @param mixed $idEnfant
     */
    public function setIdEnfant($idEnfant)
    {
        $this->idEnfant = $idEnfant;
    }
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Enfants")
     * @ORM\JoinColumn(name="idEnfant",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idEnfant;






}

