<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * 
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\BookingRepository")
 */
class Booking
{
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
     *
     * @ORM\Column(type="datetime", nullable=true, name="created")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="updated")
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true, name="bookingdate")
     */
    private $bookingdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time", nullable=true, name="timefrom")
     */
    private $timefrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time", nullable=true, name="timeto")
     */
    private $timeto;

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
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="note")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="pspiess\LetsplayBundle\Entity\Customer", inversedBy="booking")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="pspiess\LetsplayBundle\Entity\Field", inversedBy="booking")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    private $field;


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
     * @return Booking
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Booking
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set bookingdate
     *
     * @param \DateTime $bookingdate
     * @return Booking
     */
    public function setBookingdate($bookingdate)
    {
        $this->bookingdate = $bookingdate;

        return $this;
    }

    /**
     * Get bookingdate
     *
     * @return \DateTime 
     */
    public function getBookingdate()
    {
        return $this->bookingdate;
    }

    /**
     * Set timefrom
     *
     * @param \DateTime $timefrom
     * @return Booking
     */
    public function setTimefrom($timefrom)
    {
        $this->timefrom = $timefrom;

        return $this;
    }

    /**
     * Get timefrom
     *
     * @return \DateTime 
     */
    public function getTimefrom()
    {
        return $this->timefrom;
    }

    /**
     * Set timeto
     *
     * @param \DateTime $timeto
     * @return Booking
     */
    public function setTimeto($timeto)
    {
        $this->timeto = $timeto;

        return $this;
    }

    /**
     * Get timeto
     *
     * @return \DateTime 
     */
    public function getTimeto()
    {
        return $this->timeto;
    }

    /**
     * Set fieldId
     *
     * @param integer $fieldId
     * @return Booking
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * Get fieldId
     *
     * @return integer 
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Booking
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Booking
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
