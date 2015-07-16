<?php

namespace pspiess\BlogBundle\Entity;

Use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Blog
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="pspiess\BlogBundle\Entity\BlogRepository")
 */
class Blog {
    
    // <editor-fold defaultstate="collapsed" desc="relation">
    /**
     * @ORM\ManyToOne(targetEntity="Maincategory", inversedBy="blog")
     * @ORM\JoinColumn(name="maincategory_id", referencedColumnName="id")
     */
    protected $maincategory;
    
    /**
     * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="blog")
     * @ORM\JoinColumn(name="Subcategory_id", referencedColumnName="id")
     */
    protected $subcategory;
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="attribute">
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="blogname", type="string", length=255)
     */
    private $blogname;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=255)
     */
    private $thumbnail;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $faviconpath;

    /**
     * @Assert\File(maxSize = "1024k", mimeTypesMessage = "Please upload a valid Picture")
     */
    private $picture;
    
    /**
     * @Assert\File(maxSize = "1024k", mimeTypesMessage = "Please upload a valid Favicon")
     */
    private $favicon;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var integer
     *
     * @ORM\Column(name="onstart", type="integer")
     */
    private $onstart;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="random", type="integer")
     */
    private $random;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="contact", type="integer")
     */
    private $contact;
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="setter and getter">
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
     * @return Blog
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
     * @return Blog
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
     * Set date
     *
     * @param \DateTime $date
     * @return Blog
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
     * Set blogname
     *
     * @param string $blogname
     * @return Blog
     */
    public function setBlogname($blogname) {
        $this->blogname = $blogname;

        return $this;
    }

    /**
     * Get blogname
     *
     * @return string 
     */
    public function getBlogname() {
        return $this->blogname;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Blog
     */
    public function setStreet($street) {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     * @return Blog
     */
    public function setZip($zip) {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer 
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Blog
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Blog
     */
    public function setState($state) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Blog
     */
    public function setCountry($country) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Blog
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Blog
     */
    public function setPicture($picture) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture() {
        return $this->picture;
    }
    
     /**
     * Set favicon
     *
     * @param string $favicon
     * @return favicon
     */
    public function setFavicon($favicon) {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getFavicon() {
        return $this->favicon;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Blog
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
     * Set maincategory
     *
     * @param \pspiess\BlogBundle\Entity\Maincategory $maincategory
     * @return Blog
     */
    public function setMaincategory(\pspiess\BlogBundle\Entity\Maincategory $maincategory = null) {
        $this->maincategory = $maincategory;

        return $this;
    }

    /**
     * Get maincategory
     *
     * @return \pspiess\BlogBundle\Entity\Maincategory 
     */
    public function getMaincategory() {
        return $this->maincategory;
    }

    /**
     * Set subcategory
     *
     * @param \pspiess\BlogBundle\Entity\Subcategory $subcategory
     * @return Blog
     */
    public function setSubcategory(\pspiess\BlogBundle\Entity\Subcategory $subcategory = null) {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \pspiess\BlogBundle\Entity\Subcategory 
     */
    public function getSubcategory() {
        return $this->subcategory;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Blog
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

        /**
     * Set faviconpath
     *
     * @param string $faviconpath
     * @return Blog
     */
    public function setFaviconpath($faviconpath) {
        $this->faviconpath = $faviconpath;

        return $this;
    }

    /**
     * Get faviconpath
     *
     * @return string 
     */
    public function getFaviconpath() {
        return $this->faviconpath;
    }
    
      /**
     * Set active
     *
     * @param integer $active
     * @return Blog
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive() {
        return $this->active;
    }


    /**
     * Set onstart
     *
     * @param integer $onstart
     * @return Blog
     */
    public function setOnstart($onstart)
    {
        $this->onstart = $onstart;

        return $this;
    }

    /**
     * Get onstart
     *
     * @return integer 
     */
    public function getOnstart()
    {
        return $this->onstart;
    }

    /**
     * Set random
     *
     * @param integer $random
     * @return Blog
     */
    public function setRandom($random)
    {
        $this->random = $random;

        return $this;
    }

    /**
     * Get random
     *
     * @return integer 
     */
    public function getRandom()
    {
        return $this->random;
    }

    /**
     * Set contact
     *
     * @param integer $contact
     * @return Blog
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return integer 
     */
    public function getContact()
    {
        return $this->contact;
    }
    // </editor-fold>
    
    // <editor-fold desc="picture functions">
    public function getFullPicturePath($path) {
        return null === $path ? null : $this->getUploadRootDir() . $path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . $this->getId() . "/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/resources/images/blog/';
    }
    // </editor-fold>
    
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function uploadPicture() {
        // the file property can be empty if the field is not required
        if (null === $this->picture) {
            return;
        }
        if (!$this->id) {
            $this->picture->move($this->getTmpUploadRootDir(), $this->picture->getClientOriginalName());
        } else {
            $this->picture->move($this->getUploadRootDir(), $this->picture->getClientOriginalName());
        }
        $this->setPath($this->picture->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist
     */
    public function movePicture() {
        if (null === $this->picture) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->path, $this->getFullPicturePath($this->path));
        unlink($this->getTmpUploadRootDir() . $this->path);
    }

    /**
     * @ORM\PreRemove
     */
    public function removePicture() {
        if (file_exists($this->getFullPicturePath($this->path))) {
            unlink($this->getFullPicturePath($this->path));
        }
        if (is_dir($this->getUploadRootDir())) {
            //rmdir($this->getUploadRootDir());
        }
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function uploadFavicon() {
        if (null === $this->favicon) {
            return;
        }
        if (!$this->id) {
            $this->favicon->move($this->getTmpUploadRootDir(), $this->favicon->getClientOriginalName());
        } else {
            $this->favicon->move($this->getUploadRootDir(), $this->favicon->getClientOriginalName());
        }
        $this->setFaviconpath($this->favicon->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist
     */
    public function moveFavicon() {
        if (null === $this->favicon) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->faviconpath, $this->getFullPicturePath($this->faviconpath));
        unlink($this->getTmpUploadRootDir() . $this->faviconpath);
    }

    /**
     * @ORM\PreRemove
     */
    public function removeFavicon() {
        if (file_exists($this->getFullPicturePath($this->faviconpath))) {
            unlink($this->getFullPicturePath($this->faviconpath));
        }
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Blog
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}
