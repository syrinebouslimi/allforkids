<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @ORM\Column(name="nomReclameur", type="string", length=255)
     */
    private $nomReclameur;

    /**
     * @return string
     */
    public function getNomReclameur()
    {
        return $this->nomReclameur;
    }

    /**
     * @param string $nomReclameur
     */
    public function setNomReclameur($nomReclameur)
    {
        $this->nomReclameur = $nomReclameur;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="contenuReclamation", type="string", length=255)
     */
    private $contenuReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="emetteurReclamation", type="string", length=255)
     */
    private $emetteurReclamation;







    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUserReclamation",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserReclamation;


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
     * Set contenuReclamation
     *
     * @param string $contenuReclamation
     *
     * @return Reclamation
     */
    public function setContenuReclamation($contenuReclamation)
    {
        $this->contenuReclamation = $contenuReclamation;

        return $this;
    }

    /**
     * Get contenuReclamation
     *
     * @return string
     */
    public function getContenuReclamation()
    {
        return $this->contenuReclamation;
    }


    /**
     * @return string
     */
    public function getEmetteurReclamation()
    {
        return $this->emetteurReclamation;
    }

    /**
     * @param string $emetteurReclamation
     */
    public function setEmetteurReclamation($emetteurReclamation)
    {
        $this->emetteurReclamation = $emetteurReclamation;
    }




    /**
     * @return mixed
     */
    public function getIdUserReclamation()
    {
        return $this->idUserReclamation;
    }

    /**
     * @param mixed $idUserReclamation
     */
    public function setIdUserReclamation($idUserReclamation)
    {
        $this->idUserReclamation = $idUserReclamation;
    }




}