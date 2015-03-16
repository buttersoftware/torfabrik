<?php

namespace pspiess\LetsplayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoicepos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="pspiess\LetsplayBundle\Entity\InvoiceposRepository")
 */
class Invoicepos
{
    /**
     * @ORM\ManyToOne(targetEntity="Invoice", inversedBy="invoicepos")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    protected $invoice;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="pos", type="integer")
     */
    private $pos;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=6, scale=2, nullable=true) 
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="total_price", type="decimal", precision=6, scale=2)
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="tax", type="decimal", precision=6, scale=2)
     */
    private $tax;


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
     * Set pos
     *
     * @param integer $pos
     * @return Invoicepos
     */
    public function setPos($pos)
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * Get pos
     *
     * @return integer 
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return Invoicepos
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Invoicepos
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
     * Set discount
     *
     * @param string $discount
     * @return Invoicepos
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     * @return Invoicepos
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Invoicepos
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     * @return Invoicepos
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string 
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return Invoicepos
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string 
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set invoice
     *
     * @param \pspiess\LetsplayBundle\Entity\Invoice $invoice
     * @return Invoicepos
     */
    public function setInvoice(\pspiess\LetsplayBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \pspiess\LetsplayBundle\Entity\Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
