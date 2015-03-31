<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
Use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="category")
     **/
    private $booking;
    
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
     * @ORM\Column(name="acronym", type="string", length=10)
     */
    private $acronym;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true,)
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
     * Set acronym
     *
     * @param string $acronym
     * @return Category
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string 
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Category
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
     * Set created
     *
     * @param \DateTime $created
     * @return Category
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
     * @return Category
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
     * Set booking
     *
     * @param \pspiess\LetsplayBundle\Entity\Booking $booking
     * @return Category
     */
    public function setBooking(\pspiess\LetsplayBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \pspiess\LetsplayBundle\Entity\Booking 
     */
    public function getBooking()
    {
        return $this->booking;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->booking = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add booking
     *
     * @param \pspiess\LetsplayBundle\Entity\Booking $booking
     * @return Category
     */
    public function addBooking(\pspiess\LetsplayBundle\Entity\Booking $booking)
    {
        $this->booking[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \pspiess\LetsplayBundle\Entity\Booking $booking
     */
    public function removeBooking(\pspiess\LetsplayBundle\Entity\Booking $booking)
    {
        $this->booking->removeElement($booking);
    }
}
