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
     * @ORM\OneToOne(targetEntity="Invoice", inversedBy="payofficepos") 
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
   protected $invoice;  

   
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
     * @ORM\Column(name="amount", type="decimal", precision=6, scale=2)
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
     * Set payoffice
     *
     * @param \pspiess\LetsplayBundle\Entity\Payoffice $payoffice
     * @return Payofficepos
     */
    public function setPayoffice(\pspiess\LetsplayBundle\Entity\Payoffice $payoffice = null)
    {
        $this->payoffice = $payoffice;

        return $this;
    }

    /**
     * Get payoffice
     *
     * @return \pspiess\LetsplayBundle\Entity\Payoffice 
     */
    public function getPayoffice()
    {
        return $this->payoffice;
    }

    /**
     * Set invoice
     *
     * @param \pspiess\LetsplayBundle\Entity\Payofficepos $invoice
     * @return Payofficepos
     */
    public function setInvoice(\pspiess\LetsplayBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;
//        $invoice->setInvoice($this);
        return $this;
    }

    /**
     * Get invoice
     *
     * @return \pspiess\LetsplayBundle\Entity\Payofficepos 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
