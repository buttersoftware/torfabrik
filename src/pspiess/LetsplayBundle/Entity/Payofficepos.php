<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payofficepos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\PayofficeposRepository")
 */
class Payofficepos {

    /**
     * @ORM\ManyToOne(targetEntity="Payoffice", inversedBy="payofficepos")
     * @ORM\JoinColumn(name="payoffice_id", referencedColumnName="id")
     */
    protected $payoffice;

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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Payofficepos
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Payofficepos
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount() {
        return $this->amount;
    }


    /**
     * Set invoice
     *
     * @param \pspiess\LetsplayBundle\Entity\Payoffice $invoice
     * @return Payofficepos
     */
    public function setInvoice(\pspiess\LetsplayBundle\Entity\Payoffice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \pspiess\LetsplayBundle\Entity\Payoffice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
