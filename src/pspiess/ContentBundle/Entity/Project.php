<?php

namespace pspiess\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table("project")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="pspiess\ContentBundle\Entity\ProjectRepository")
 */
class Project {

    /**
     * @ORM\OneToMany(targetEntity="Pictures", mappedBy="project")
     */
    protected $pictures;

    public function __construct() {
        $this->pictures = new ArrayCollection();
        $this->created = new \DateTime();
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="short", type="text")
     */
    private $short;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize = "1024k", mimeTypesMessage = "Please upload a valid Picture")
     */
    private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="smallint")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set short
     *
     * @param string $short
     * @return Project
     */
    public function setShort($short) {
        $this->short = $short;

        return $this;
    }

    /**
     * Get short
     *
     * @return string 
     */
    public function getShort() {
        return $this->short;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Project
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Project
     */
    public function setCategory($category) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set path of a picture
     *
     * @param string $path
     * @return Project
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path of a picture
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Project
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
     * Set active
     *
     * @param integer $active
     * @return Project
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
     * Set created
     *
     * @param \DateTime $created
     * @return Project
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

    public function getFullPicturePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . $this->path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . $this->getId() . "/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/resources/images/project/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
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
     * @ORM\PostPersist()
     */
    public function movePicture() {
        if (null === $this->picture) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->path, $this->getFullPicturePath());
        unlink($this->getTmpUploadRootDir() . $this->path);
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function deletePicture() {
        if (file_exists($this->getFullPicturePath())) {
            unlink($this->getFullPicturePath());
        }
        if (is_dir($this->getUploadRootDir())) {
            //rmdir($this->getUploadRootDir());
        }
    }

    /**
     * Add pictures
     *
     * @param \pspiess\ContentBundle\Entity\Pictures $pictures
     * @return Project
     */
    public function addPicture(\pspiess\ContentBundle\Entity\Pictures $pictures) {
        $this->pictures[] = $pictures;
        $pictures->setProject($this);
        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \pspiess\ContentBundle\Entity\Pictures $pictures
     */
    public function removePicture(\pspiess\ContentBundle\Entity\Pictures $pictures) {
        $this->pictures->removeElement($pictures);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures() {
        return $this->pictures;
    }

    /**
     * Override toString() method to return the name of the project title
     * @return string title
     */
    public function __toString() {
        return $this->title;
    }

}
