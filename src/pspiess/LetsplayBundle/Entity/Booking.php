<?php

namespace pspiess\LetsplayBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * 
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\BookingRepository")
 */
class Booking {

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="booking") 
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="pspiess\LetsplayBundle\Entity\Customer", inversedBy="bookings")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="pspiess\LetsplayBundle\Entity\Field", inversedBy="bookings")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    private $field;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true, name="created")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true, name="changed")
     */
    private $changed;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="title")
     */
    private $title = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="start")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="end")
     */
    private $end;

    /**
     * @var integer
     *
     * 
     */
    private $fieldId;

    /**
     * @var integer
     *
     * 
     */
    private $customerId;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="cancellation", options={"default" = "0"}, nullable=true)
     */
    private $cancellation;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="note")
     */
    private $note;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="invoice_id", nullable=true)
     */
    private $InvoiceId;

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
     * @return Booking
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
     * @return Booking
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
     * Set bookingdate
     *
     * @param \DateTime $bookingdate
     * @return Booking
     */
    public function setBookingdate($bookingdate) {
        $this->bookingdate = $bookingdate;

        return $this;
    }

    /**
     * Get bookingdate
     *
     * @return \DateTime 
     */
    public function getBookingdate() {
        return $this->bookingdate;
    }

    /**
     * Get title
     *
     * @return \String 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return start
     */
    public function setStart($start) {
        $this->start = $start;

        return $this;
    }

    /**
     * Get title
     *
     * @return \String 
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return end
     */
    public function setEnd($end) {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Set fieldId
     *
     * @param integer $fieldId
     * @return Booking
     */
    public function setFieldId($fieldId) {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * Get fieldId
     *
     * @return integer 
     */
    public function getFieldId() {
        return $this->fieldId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Booking
     */
    public function setCustomerId($customerId) {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId() {
        return $this->customerId;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Booking
     */
    public function setNote($note) {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return title
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Set customer
     *
     * @param \pspiess\LetsplayBundle\Entity\Customer $customer
     * @return Booking
     */
    public function setCustomer(\pspiess\LetsplayBundle\Entity\Customer $customer = null) {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \pspiess\LetsplayBundle\Entity\Customer 
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * Set field
     *
     * @param \pspiess\LetsplayBundle\Entity\Field $field
     * @return Booking
     */
    public function setField(\pspiess\LetsplayBundle\Entity\Field $field = null) {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \pspiess\LetsplayBundle\Entity\Field 
     */
    public function getField() {
        return $this->field;
    }

    /**
     * Set cancellation
     *
     * @param integer $cancellation
     * @return Booking
     */
    public function setCancellation($cancellation) {
        $this->cancellation = $cancellation;

        return $this;
    }

    /**
     * Get cancellation
     *
     * @return integer 
     */
    public function getCancellation() {
        return $this->cancellation;
    }

    /**
     * Set InvoiceId
     *
     * @param integer $invoiceId
     * @return Booking
     */
    public function setInvoiceId($invoiceId) {
        $this->InvoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get InvoiceId
     *
     * @return integer 
     */
    public function getInvoiceId() {
        return $this->InvoiceId;
    }


    /**
     * Set category
     *
     * @param \pspiess\LetsplayBundle\Entity\Category $category
     * @return Booking
     */
    public function setCategory(\pspiess\LetsplayBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \pspiess\LetsplayBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
