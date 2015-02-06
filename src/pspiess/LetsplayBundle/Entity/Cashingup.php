<?php

namespace pspiess\LetsplayBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cashingup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\CashingupRepository")
 */
class Cashingup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="created")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="changed")
     * @Gedmo\Timestampable(on="update")
     */
    private $changed;

    /**
     * @var string
     *
     * @ORM\Column(name="nominal", type="decimal")
     */
    private $nominal;

    /**
     * @var string
     *
     * @ORM\Column(name="actual", type="decimal")
     */
    private $actual;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="daydate", type="date")
     */
    private $daydate;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text")
     */
    private $note;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Cashingup
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     * @return Cashingup
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;

        return $this;
    }

    /**
     * Get changed
     *
     * @return \DateTime 
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * Set nominal
     *
     * @param string $nominal
     * @return Cashingup
     */
    public function setNominal($nominal)
    {
        $this->nominal = $nominal;

        return $this;
    }

    /**
     * Get nominal
     *
     * @return string 
     */
    public function getNominal()
    {
        return $this->nominal;
    }

    /**
     * Set actual
     *
     * @param string $actual
     * @return Cashingup
     */
    public function setActual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    /**
     * Get actual
     *
     * @return string 
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Set daydate
     *
     * @param \DateTime $daydate
     * @return Cashingup
     */
    public function setDaydate($daydate)
    {
        $this->daydate = $daydate;

        return $this;
    }

    /**
     * Get daydate
     *
     * @return \DateTime 
     */
    public function getDaydate()
    {
        return $this->daydate;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Cashingup
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
