<?php

namespace pspiess\ContentBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pictures
 *
 * @ORM\Table("pictures")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="pspiess\ContentBundle\Entity\PicturesRepository")
 */
class Pictures
{
     /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="pictures")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;
    
    public function __construct() {
        //$this->project = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;
    
    /**
     * @Assert\File(maxSize = "1024k", mimeTypesMessage = "Bitte laden wählen Sie ein gültiges Bild aus.")
     */
    private $picture;
    

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
     * Set title
     *
     * @param string $title
     * @return Pictures
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set path of a picture
     *
     * @param string $picture
     * @return picture
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
     * @return Pictures
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set project
     *
     * @param \pspiess\ContentBundle\Entity\Project $project
     * @return Pictures
     */
    public function setProject(\pspiess\ContentBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \pspiess\ContentBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
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
        return __DIR__ . '/../../../../web/resources/images/project/picture/';
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
