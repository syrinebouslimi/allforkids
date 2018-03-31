<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="nomProduit", type="string", length=255)
     */
    private $nomProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionProduit", type="string", length=255)
     */
    private $descriptionProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="prixProduit", type="string", length=255)
     */
    private $prixProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteProduit", type="integer")
     */
    private $quantiteProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="imageProduit", type="string", length=255)
     */
    private $imageProduit;


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
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Produit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * Set descriptionProduit
     *
     * @param string $descriptionProduit
     *
     * @return Produit
     */
    public function setDescriptionProduit($descriptionProduit)
    {
        $this->descriptionProduit = $descriptionProduit;

        return $this;
    }

    /**
     * Get descriptionProduit
     *
     * @return string
     */
    public function getDescriptionProduit()
    {
        return $this->descriptionProduit;
    }

    /**
     * Set prixProduit
     *
     * @param string $prixProduit
     *
     * @return Produit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    /**
     * Get prixProduit
     *
     * @return string
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * Set quantiteProduit
     *
     * @param integer $quantiteProduit
     *
     * @return Produit
     */
    public function setQuantiteProduit($quantiteProduit)
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }

    /**
     * Get quantiteProduit
     *
     * @return int
     */
    public function getQuantiteProduit()
    {
        return $this->quantiteProduit;
    }

    /**
     * Set imageProduit
     *
     * @param string $imageProduit
     *
     * @return Produit
     */
    public function setImageProduit($imageProduit)
    {
        $this->imageProduit = $imageProduit;

        return $this;
    }

    /**
     * Get imageProduit
     *
     * @return string
     */
    public function getImageProduit()
    {
        return $this->imageProduit;
    }
}

