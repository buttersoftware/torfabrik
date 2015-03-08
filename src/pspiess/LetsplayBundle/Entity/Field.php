<?php

namespace pspiess\LetsplayBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Field
 *
 * 
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\FieldRepository")
 */
class Field {

    public function __construct() {
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $prices
     * 
     * @ORM\ManyToMany(targetEntity="pspiess\LetsplayBundle\Entity\Price", inversedBy="fields")
     * @ORM\JoinTable(
     *     name="Field_Price",
     *     joinColumns={@ORM\JoinColumn(name="field_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="price_id", referencedColumnName="id")}
     * )
     * */
    protected $prices;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="fieldnr", unique=true)
     */
    private $fieldnr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="type")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", nullable=true, name="slots")
     */
    private $slots;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="ground")
     */
    private $ground;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true, name="care")
     */
    private $care;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", nullable=true, name="lenght")
     */
    private $lenght;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", nullable=true, name="width")
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="note")
     */
    private $note;

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
     * @ORM\Column(type="date", nullable=true, name="activation")
     */
    private $activation;

    /**
     * @ORM\OneToMany(targetEntity="pspiess\LetsplayBundle\Entity\Booking", mappedBy="field")
     */
    private $bookings;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fieldnr
     *
     * @param integer $fieldnr
     * @return Field
     */
    public function setFieldnr($fieldnr) {
        $this->fieldnr = $fieldnr;

        return $this;
    }

    /**
     * Get fieldnr
     *
     * @return integer 
     */
    public function getFieldnr() {
        return $this->fieldnr;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Field
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set slots
     *
     * @param integer $slots
     * @return Field
     */
    public function setSlots($slots) {
        $this->slots = $slots;

        return $this;
    }

    /**
     * Get slots
     *
     * @return integer 
     */
    public function getSlots() {
        return $this->slots;
    }

    /**
     * Set ground
     *
     * @param string $ground
     * @return Field
     */
    public function setGround($ground) {
        $this->ground = $ground;

        return $this;
    }

    /**
     * Get ground
     *
     * @return string 
     */
    public function getGround() {
        return $this->ground;
    }

    /**
     * Set care
     *
     * @param \DateTime $care
     * @return Field
     */
    public function setCare($care) {
        $this->care = $care;

        return $this;
    }

    /**
     * Get care
     *
     * @return \DateTime 
     */
    public function getCare() {
        return $this->care;
    }

    /**
     * Set lenght
     *
     * @param string $lenght
     * @return Field
     */
    public function setLenght($lenght) {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return string 
     */
    public function getLenght() {
        return $this->lenght;
    }

    /**
     * Set width
     *
     * @param string $width
     * @return Field
     */
    public function setWidth($width) {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Field
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
     * Set created
     *
     * @param \DateTime $created
     * @return Field
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
     * @return Field
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
     * Set activation
     *
     * @param \DateTime $activation
     * @return Field
     */
    public function setActivation($activation) {
        $this->activation = $activation;

        return $this;
    }

    /**
     * Get activation
     *
     * @return \DateTime 
     */
    public function getActivation() {
        return $this->activation;
    }

    /**
     * Add price
     *
     * @param \pspiess\LetsplayBundle\Entity\Price $price
     * @return Field
     */
    public function addPrice(\pspiess\LetsplayBundle\Entity\Price $price)
    {
        $this->prices[] = $price;
    }

    /**
     * Remove price
     *
     * @param \pspiess\LetsplayBundle\Entity\Price $price
     */
    public function removePrice(\pspiess\LetsplayBundle\Entity\Price $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get price
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrice()
    {
        return $this->prices;
    }
    
    /*
     * @return string
     */
    public function __toString() {
        return $this->type;
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Add booking
     *
     * @param \pspiess\LetsplayBundle\Entity\Booking $bookings
     * @return Field
     */
    public function addBooking(\pspiess\LetsplayBundle\Entity\Booking $bookings)
    {
        $this->bookings[] = $bookings;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \pspiess\LetsplayBundle\Entity\Booking $bookings
     */
    public function removeBooking(\pspiess\LetsplayBundle\Entity\Booking $bookings)
    {
        $this->bookings->removeElement($bookings);
    }

    /**
     * Get booking
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}
