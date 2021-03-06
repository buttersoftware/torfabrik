<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
Use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * 
 * @ORM\HasLifecycleCallbacks 
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\CustomerRepository")
 */
class Customer {

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="title")
     */
    private $title = '';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize = "1024k", mimeTypesMessage = "Bitte wählen Sie ein gültiges Bild aus.")
     */
    private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, name="customernr")
     */
    private $customernr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="name")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="firstname")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="addon")
     */
    private $addon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="street")
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, name="zip")
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="location")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="country")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="phone")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="mobile")
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true, name="fax")
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, name="note")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", nullable=true, name="discount")
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true, name="birthday")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true, name="sex")
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=34, nullable=true, name="sepa")
     */
    private $sepa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=11, nullable=true, name="bic")
     */
    private $bic;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, name="cashing")
     */
    private $cashing;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="bank")
     */
    private $bank;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="bank_owner")
     */
    private $bankOwner;

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
     * @ORM\OneToMany(targetEntity="pspiess\LetsplayBundle\Entity\Booking", mappedBy="customer")
     */
    private $bookings;

    public function __construct() {
        $this->bookings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
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
     * Set title
     *
     * @param string $title
     * @return Customer
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
     * Set customernr
     *
     * @param integer $customernr
     * @return Customer
     */
    public function setCustomernr($customernr) {
        $this->customernr = $customernr;

        return $this;
    }

    /**
     * Get customernr
     *
     * @return integer 
     */
    public function getCustomernr() {
        return $this->customernr;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Customer
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Customer
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set addon
     *
     * @param string $addon
     * @return Customer
     */
    public function setAddon($addon) {
        $this->addon = $addon;

        return $this;
    }

    /**
     * Get addon
     *
     * @return string 
     */
    public function getAddon() {
        return $this->addon;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Customer
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
     * @return Customer
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
     * @return Customer
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
     * Set country
     *
     * @param string $country
     * @return Customer
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
     * Set phone
     *
     * @param string $phone
     * @return Customer
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Customer
     */
    public function setFax($fax) {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Customer
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
     * Set discount
     *
     * @param string $discount
     * @return Customer
     */
    public function setDiscount($discount) {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount() {
        return $this->discount;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Customer
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Customer
     */
    public function setSex($sex) {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex() {
        return $this->sex;
    }

    /**
     * Set sepa
     *
     * @param string $sepa
     * @return Customer
     */
    public function setSepa($sepa) {
        $this->sepa = $sepa;

        return $this;
    }

    /**
     * Get sepa
     *
     * @return string 
     */
    public function getSepa() {
        return $this->sepa;
    }

    /**
     * Set bic
     *
     * @param string $bic
     * @return Customer
     */
    public function setBic($bic) {
        $this->bic = $bic;

        return $this;
    }

    /**
     * Get bic
     *
     * @return string 
     */
    public function getBic() {
        return $this->bic;
    }

    /**
     * Set cashing
     *
     * @param boolean $cashing
     * @return Customer
     */
    public function setCashing($cashing) {
        $this->cashing = $cashing;

        return $this;
    }

    /**
     * Get cashing
     *
     * @return boolean 
     */
    public function getCashing() {
        return $this->cashing;
    }

    /**
     * Set bank
     *
     * @param string $bank
     * @return Customer
     */
    public function setBank($bank) {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string 
     */
    public function getBank() {
        return $this->bank;
    }

    /**
     * Set bankOwner
     *
     * @param string $bankOwner
     * @return Customer
     */
    public function setBankOwner($bankOwner) {
        $this->bankOwner = $bankOwner;

        return $this;
    }

    /**
     * Get bankOwner
     *
     * @return string 
     */
    public function getBankOwner() {
        return $this->bankOwner;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Customer
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
     * @return Customer
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

    public function getFullPicturePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . $this->path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . $this->getId() . "/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/resources/images/customer/';
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

    public function __toString() {
        return $this->firstname.', '.$this->name;
    }

}
