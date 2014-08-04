<?php

namespace pspiess\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * slider
 *
 * @ORM\Table("slider")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="pspiess\ContentBundle\Entity\SliderRepository")
 */
class Slider {

    public function __construct() {
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="linktext", type="string", length=255)
     */
    private $linktext;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="smallint")
     */
    private $rank;

    /**
     * @var string
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
     * @ORM\Column(name="active", type="boolean")
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
     * @return slider
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
     * Set content
     *
     * @param string $content
     * @return slider
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
     * Set link
     *
     * @param string $link
     * @return slider
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set linktext
     *
     * @param string $linktext
     * @return slider
     */
    public function setLinktext($linktext) {
        $this->linktext = $linktext;

        return $this;
    }

    /**
     * Get linktext
     *
     * @return string 
     */
    public function getLinktext() {
        return $this->linktext;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return slider
     */
    public function setRank($rank) {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank() {
        return $this->rank;
    }

    /**
     * Set path of a picture
     *
     * @param string $picture
     * @return slider
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
     * @return slider
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
     * @return slider
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
     * @return slider
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
        return __DIR__ . '/../../../../web/resources/images/slider/';
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
    public function removePicture() {
        if (file_exists($this->getFullPicturePath())) {
            unlink($this->getFullPicturePath());
        }
        if (is_dir($this->getUploadRootDir())) {
            //rmdir($this->getUploadRootDir());
        }
    }

}
