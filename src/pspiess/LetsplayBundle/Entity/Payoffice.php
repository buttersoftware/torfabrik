<?php

namespace pspiess\LetsplayBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Payoffice
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\PayofficeRepository")
 */
class Payoffice {

    /**
     * @ORM\OneToMany(targetEntity="Payofficepos", mappedBy="payoffice", cascade={"persist", "remove"})
     */
    protected $payofficepos;

    public function __construct() {
        $this->payofficepos = new ArrayCollection();
    }

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
     * @var \DateTime
     *
     * @ORM\Column(name="opened", type="datetime", nullable=true)
     */
    private $opened;

    /**
     * @var \DateTime
     * @ORM\Column(name="closed", type="datetime", nullable=true)
     */
    private $closed;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Payoffice
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     * @return Payoffice
     */
    public function setChanged($changed) {
        $this->changed = $changed;

        return $this;
    }

    /**
     * Get changed
     *
     * @return \DateTime 
     */
    public function getChanged() {
        return $this->changed;
    }

    /**
     * Set opened
     * @param \DateTime $opened
     * @return Payoffice
     */
    public function setOpened($opened) {
        $this->opened = $opened;

        return $this;
    }

    /**
     * Get opened
     *
     * @return \DateTime 
     */
    public function getOpened() {
        return $this->opened;
    }

    /**
     * Set closed
     * @param \DateTime $closed
     * @return Payoffice
     */
    public function setClosed($closed) {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return \DateTime 
     */
    public function getClosed() {
        return $this->closed;
    }


    /**
     * Add payofficepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Payofficepos $payofficepos
     * @return Payoffice
     */
    public function addPayofficepos(\pspiess\LetsplayBundle\Entity\Payofficepos $payofficepos)
    {
        $this->payofficepos[] = $payofficepos;
        $payofficepos->setPayoffice($this);
        return $this;
    }

    /**
     * Remove payofficepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Payofficepos $payofficepos
     */
    public function removePayofficepo(\pspiess\LetsplayBundle\Entity\Payofficepos $payofficepos)
    {
        $this->payofficepos->removeElement($payofficepos);
    }

    /**
     * Get payofficepos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayofficepos()
    {
        return $this->payofficepos;
    }
}
