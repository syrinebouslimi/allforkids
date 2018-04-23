<?php

namespace UserBundle\Entity;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent  ;
use Doctrine\ORM\Mapping as ORM;

/**
 * EventCustom
 * @ORM\Table(name="event_club")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EventCustomRepository")
 */
class EventCustom extends FullCalendarEvent
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
    public function getNomEvnt()
    {
        return $this->nomEvnt;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param string $nomEvnt
     */
    public function setNomEvnt($nomEvnt)
    {
        $this->nomEvnt = $nomEvnt;
    }

    /**
     * @return string
     */
    public function getEtatEvnt()
    {
        return $this->etatEvnt;
    }

    /**
     * @param string $etatEvnt
     */
    public function setEtatEvnt($etatEvnt)
    {
        $this->etatEvnt = $etatEvnt;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebutEvnt()
    {
        return $this->datedebutEvnt;
    }

    /**
     * @param \DateTime $datedebutEvnt
     */
    public function setDatedebutEvnt($datedebutEvnt)
    {
        $this->datedebutEvnt = $datedebutEvnt;
    }

    /**
     * @return \DateTime
     */
    public function getDatefinEvnt()
    {
        return $this->datefinEvnt;
    }

    /**
     * @param \DateTime $datefinEvnt
     */
    public function setDatefinEvnt($datefinEvnt)
    {
        $this->datefinEvnt = $datefinEvnt;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nomEvnt", type="string", length=255)
     */
    private $nomEvnt;

    /**
     * @var string
     *
     * @ORM\Column(name="etatEvnt", type="string", length=4000)
     */
    private $etatEvnt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebutEvnt", type="datetime")
     */
    private $datedebutEvnt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinEvnt", type="datetime")
     */
    private $datefinEvnt;

    /**
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }


    public function __construct()
    {

    }


}

