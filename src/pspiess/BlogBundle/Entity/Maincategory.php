<?php

namespace pspiess\BlogBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Maincategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\BlogBundle\Entity\MaincategoryRepository")
 */
class Maincategory {

    public function __construct() {
        $this->subcategory = new ArrayCollection();
        $this->blog = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="maincategory", cascade={"persist", "remove"})
     */
    protected $subcategory;

    /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="maincategory", cascade={"persist", "remove"})
     */
    protected $blog;

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
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="string", length=255, nullable=true)
     */
    private $description_en;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Maincategory
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
     * @return Maincategory
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
     * Set number
     *
     * @param integer $number
     * @return Maincategory
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Maincategory
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Maincategory
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
     * Add subcategory
     *
     * @param \pspiess\BlogBundle\Entity\Subcategory $subcategory
     * @return Maincategory
     */
    public function addSubcategory(\pspiess\BlogBundle\Entity\Subcategory $subcategory) {
        $this->subcategory[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategory
     *
     * @param \pspiess\BlogBundle\Entity\Subcategory $subcategory
     */
    public function removeSubcategory(\pspiess\BlogBundle\Entity\Subcategory $subcategory) {
        $this->subcategory->removeElement($subcategory);
    }

    /**
     * Get subcategory
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategory() {
        return $this->subcategory;
    }

    /**
     * Add blog
     *
     * @param \pspiess\BlogBundle\Entity\Blog $blog
     * @return Maincategory
     */
    public function addBlog(\pspiess\BlogBundle\Entity\Blog $blog) {
        $this->blog[] = $blog;

        return $this;
    }

    /**
     * Remove blog
     *
     * @param \pspiess\BlogBundle\Entity\Blog $blog
     */
    public function removeBlog(\pspiess\BlogBundle\Entity\Blog $blog) {
        $this->blog->removeElement($blog);
    }

    /**
     * Get blog
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlog() {
        return $this->blog;
    }

    public function __toString() {
        return $this->description;
    }


    /**
     * Set description_en
     *
     * @param string $descriptionEn
     * @return Maincategory
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->description_en = $descriptionEn;

        return $this;
    }

    /**
     * Get description_en
     *
     * @return string 
     */
    public function getDescriptionEn()
    {
        return $this->description_en;
    }
}
