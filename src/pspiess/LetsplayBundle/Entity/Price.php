<?php

namespace pspiess\LetsplayBundle\Entity;


Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * 
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\PriceRepository")
 */
class Price {
    public function __construct() {
    }

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * @var \Doctrine\Common\Collections\ArrayCollection $fields
     * 
     * @ORM\ManyToMany(targetEntity="pspiess\LetsplayBundle\Entity\Field", mappedBy="prices")
     * */
    private $fields;

    /**
     * @var decimal
     *
     * @ORM\Column(type="decimal", nullable=true, name="price", precision=9, scale=2)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", nullable=true, name="weekdayfrom")
     */
    private $weekdayfrom;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", nullable=true, name="weekdayto")
     */
    private $weekdayto;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="indentifier")
     */
    private $indentifier;

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
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="note")
     */
    private $note;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true, name="changed")
     */
    private $changed;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Price
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set weekdayfrom
     *
     * @param integer $weekdayfrom
     * @return Price
     */
    public function setWeekdayfrom($weekdayfrom) {
        $this->weekdayfrom = $weekdayfrom;

        return $this;
    }

    /**
     * Get weekdayfrom
     *
     * @return integer 
     */
    public function getWeekdayfrom() {
        return $this->weekdayfrom;
    }

    /**
     * Set weekdayto
     *
     * @param integer $weekdayto
     * @return Price
     */
    public function setWeekdayto($weekdayto) {
        $this->weekdayto = $weekdayto;

        return $this;
    }

    /**
     * Get weekday
     *
     * @return integer 
     */
    public function getWeekdayto() {
        return $this->weekdayto;
    }

    /**
     * Set indentifier
     *
     * @param string $indentifier
     * @return Price
     */
    public function setIndentifier($indentifier) {
        $this->indentifier = $indentifier;

        return $this;
    }

    /**
     * Get indentifier
     *
     * @return string 
     */
    public function getIndentifier() {
        return $this->indentifier;
    }

    /**
     * Set timefrom
     *
     * @param \DateTime $timefrom
     * @return Price
     */
    public function setTimefrom($timefrom) {
        $this->timefrom = $timefrom;

        return $this;
    }

    /**
     * Get timefrom
     *
     * @return \DateTime 
     */
    public function getTimefrom() {
        return $this->timefrom;
    }

    /**
     * Set timeto
     *
     * @param \DateTime $timeto
     * @return Price
     */
    public function setTimeto($timeto) {
        $this->timeto = $timeto;

        return $this;
    }

    /**
     * Get timeto
     *
     * @return \DateTime 
     */
    public function getTimeto() {
        return $this->timeto;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Price
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
     * @return Price
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
     * Add field
     *
     * @param \pspiess\LetsplayBundle\Entity\Field $field
     * @return Price
     */
    public function addField(\pspiess\LetsplayBundle\Entity\Field $field) {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param \pspiess\LetsplayBundle\Entity\Field $field
     */
    public function removeField(\pspiess\LetsplayBundle\Entity\Field $field) {
        $this->fields->removeElement($field);
    }

    /**
     * Get field
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getField() {
        return $this->fields;
    }

    /*
     * @return string
     */

    public function __toString() {
        return $this->getIndentifier();
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Price
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }
}
