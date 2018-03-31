<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nomUser", type="string", length=255,nullable=true)
     */
    protected $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUser", type="string", length=255,nullable=true)
     */
    protected $prenomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseUser", type="string", length=255,nullable=true)
     */
    protected $adresseUser;

    /**
     * @var string
     *
     * @ORM\Column(name="profilePictureUser", type="string", length=255,nullable=true)
     */
    protected $profilePictureUser;

    /**
     * @var string
     *
     * @ORM\Column(name="datenaissanceUser", type="date", length=255,nullable=true)
     */
    protected $datenaissanceUser;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroTelephoneUser", type="integer", length=255,nullable=true)
     */
    protected $numeroTelephoneUser;



    /**
     * User constructor.
     * @param int $id
     */
    public function __construct()
    {
        parent::__construct();
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
     * @return string
     */
    public function getAdresseUser()
    {
        return $this->adresseUser;
    }

    /**
     * @param string $adresseUser
     */
    public function setAdresseUser($adresseUser)
    {
        $this->adresseUser = $adresseUser;
    }



    /**
     * @return string
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * @return string
     */
    public function getDatenaissanceUser()
    {
        return $this->datenaissanceUser;
    }

    /**
     * @param string $datenaissanceUser
     */
    public function setDatenaissanceUser($datenaissanceUser)
    {
        $this->datenaissanceUser = $datenaissanceUser;
    }

    /**
     * @param string $nomUser
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;
    }

    /**
     * @return string
     */
    public function getPrenomUser()
    {
        return $this->prenomUser;
    }

    /**
     * @param string $prenomUser
     */
    public function setPrenomUser($prenomUser)
    {
        $this->prenomUser = $prenomUser;
    }

    /**
     * @return string
     */
    public function getProfilePictureUser()
    {
        return $this->profilePictureUser;
    }

    /**
     * @param string $profilePictureUser
     */
    public function setProfilePictureUser($profilePictureUser)
    {
        $this->profilePictureUser = $profilePictureUser;
    }

    /**
     * @return int
     */
    public function getNumeroTelephoneUser()
    {
        return $this->numeroTelephoneUser;
    }

    /**
     * @param int $numeroTelephoneUser
     */
    public function setNumeroTelephoneUser($numeroTelephoneUser)
    {
        $this->numeroTelephoneUser = $numeroTelephoneUser;
    }



}
