<?php

namespace pspiess\LetsplayBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Invoice
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\OneToMany(targetEntity="Invoicepos", mappedBy="invoice", cascade={"persist"})
     */
    protected $invoicepos;

    public function __construct()
    {
        $this->invoicepos = new ArrayCollection();
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="invoice_number", type="integer")
     */
    private $invoiceNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_number", type="string", length=255)
     */
    private $customerNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="company_street", type="string", length=255)
     */
    private $companyStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_zip", type="integer")
     */
    private $companyZip;

    /**
     * @var string
     *
     * @ORM\Column(name="company_location", type="string", length=255)
     */
    private $companyLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="company_country", type="string", length=255)
     */
    private $companyCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="company_phone", type="string", length=255)
     */
    private $companyPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255)
     */
    private $payment;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_street", type="string", length=255)
     */
    private $customerStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_zip", type="integer")
     */
    private $customerZip;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_location", type="string", length=255)
     */
    private $customerLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_country", type="string", length=255)
     */
    private $customerCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=255)
     */
    private $customerPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
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
     * @return Invoice
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
     * Set date
     *
     * @param \DateTime $date
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set invoiceNumber
     *
     * @param integer $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return integer 
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set customerNumber
     *
     * @param string $customerNumber
     * @return Invoice
     */
    public function setCustomerNumber($customerNumber)
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    /**
     * Get customerNumber
     *
     * @return string 
     */
    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    /**
     * Set companyStreet
     *
     * @param string $companyStreet
     * @return Invoice
     */
    public function setCompanyStreet($companyStreet)
    {
        $this->companyStreet = $companyStreet;

        return $this;
    }

    /**
     * Get companyStreet
     *
     * @return string 
     */
    public function getCompanyStreet()
    {
        return $this->companyStreet;
    }

    /**
     * Set companyZip
     *
     * @param integer $companyZip
     * @return Invoice
     */
    public function setCompanyZip($companyZip)
    {
        $this->companyZip = $companyZip;

        return $this;
    }

    /**
     * Get companyZip
     *
     * @return integer 
     */
    public function getCompanyZip()
    {
        return $this->companyZip;
    }

    /**
     * Set companyLocation
     *
     * @param string $companyLocation
     * @return Invoice
     */
    public function setCompanyLocation($companyLocation)
    {
        $this->companyLocation = $companyLocation;

        return $this;
    }

    /**
     * Get companyLocation
     *
     * @return string 
     */
    public function getCompanyLocation()
    {
        return $this->companyLocation;
    }

    /**
     * Set companyCountry
     *
     * @param string $companyCountry
     * @return Invoice
     */
    public function setCompanyCountry($companyCountry)
    {
        $this->companyCountry = $companyCountry;

        return $this;
    }

    /**
     * Get companyCountry
     *
     * @return string 
     */
    public function getCompanyCountry()
    {
        return $this->companyCountry;
    }

    /**
     * Set companyPhone
     *
     * @param string $companyPhone
     * @return Invoice
     */
    public function setCompanyPhone($companyPhone)
    {
        $this->companyPhone = $companyPhone;

        return $this;
    }

    /**
     * Get companyPhone
     *
     * @return string 
     */
    public function getCompanyPhone()
    {
        return $this->companyPhone;
    }

    /**
     * Set payment
     *
     * @param string $payment
     * @return Invoice
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set customerStreet
     *
     * @param string $customerStreet
     * @return Invoice
     */
    public function setCustomerStreet($customerStreet)
    {
        $this->customerStreet = $customerStreet;

        return $this;
    }

    /**
     * Get customerStreet
     *
     * @return string 
     */
    public function getCustomerStreet()
    {
        return $this->customerStreet;
    }

    /**
     * Set customerZip
     *
     * @param integer $customerZip
     * @return Invoice
     */
    public function setCustomerZip($customerZip)
    {
        $this->customerZip = $customerZip;

        return $this;
    }

    /**
     * Get customerZip
     *
     * @return integer 
     */
    public function getCustomerZip()
    {
        return $this->customerZip;
    }

    /**
     * Set customerLocation
     *
     * @param string $customerLocation
     * @return Invoice
     */
    public function setCustomerLocation($customerLocation)
    {
        $this->customerLocation = $customerLocation;

        return $this;
    }

    /**
     * Get customerLocation
     *
     * @return string 
     */
    public function getCustomerLocation()
    {
        return $this->customerLocation;
    }

    /**
     * Set customerCountry
     *
     * @param string $customerCountry
     * @return Invoice
     */
    public function setCustomerCountry($customerCountry)
    {
        $this->customerCountry = $customerCountry;

        return $this;
    }

    /**
     * Get customerCountry
     *
     * @return string 
     */
    public function getCustomerCountry()
    {
        return $this->customerCountry;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     * @return Invoice
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string 
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Invoice
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

    /**
     * Add invoicepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos
     * @return Invoice
     */
    public function addInvoicepos(\pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos)
    {
        $this->invoicepos[] = $invoicepos;
        $invoicepos->setInvoice($this);
        return $this;
    }

    /**
     * Remove invoicepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos
     */
    public function removeInvoicepos(\pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos)
    {
        $this->invoicepos->removeElement($invoicepos);
    }

    /**
     * Get invoicepos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoicepos()
    {
        return $this->invoicepos;
    }

    /**
     * Add invoicepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos
     * @return Invoice
     */
    public function addInvoicepo(\pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos)
    {
        $this->invoicepos[] = $invoicepos;

        return $this;
    }

    /**
     * Remove invoicepos
     *
     * @param \pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos
     */
    public function removeInvoicepo(\pspiess\LetsplayBundle\Entity\Invoicepos $invoicepos)
    {
        $this->invoicepos->removeElement($invoicepos);
    }

    /**
     * Set changed
     *
     * @param \DateTime $changed
     * @return Invoice
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
}
