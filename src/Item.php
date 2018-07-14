<?php 

/**
 * Sinvoice an invoicing model.
 * 
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in 
 * this paackage.
 */

namespace Rabus\Sinvoice;

/**
 * Item
 * 
 * What does a Sinvoice need more than oxygen and coffee? An item! So don't 
 * leave your Sinvoice all alone with 0 items, that would be just sinful!
 * 
 * This is a Sinvoice Item. All Invoices are created and then items are 
 * attached to the invoice.
 * 
 * To add an item you should:
 *
 *  $invoice = new Invoice();
 * 
 *  $basketball = new Item();
 *  $basketball->name = "Defacto Basketball";
 *  $basketball->price = "29.99";
 *  $basketball->quantity = 1;
 * 
 *  $invoice->addItem($basketball);
 *  
 * @author RABUS
 */
class Item {

    /**
     * @var string $name Is the name of the item, 'Basketball' or 'Bitcoin Mug'.
     */
    private $name;

    /**
     * @var string $description is the item description if needed. Default is 
     * automatically set.
     */
    private $description;

    /**
     * @var integer $price Is the price of the item in integer or decimal 
     * format, '20', or '21.99'.
     */
    private $price;

    /**
     * @var integer $quantity Is the number of items.
     */
    private $quantity;

    /**
     * @var integer $discountPercentage Is the discount you with to give on the
     * item in a percentage format. So if you wanted to give a 20% discount you 
     * would set it at '20'.
     */
    public $discountPercentage;

    /**
     * Construct
     *
     * As well as contrusting the item we can set any default attribute values
     * we want to define.
     */
    public function __construct()
    {
    }

    /**
     * Set the name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set the price
     *
     * We will ensure the price is rounded
     *
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = round($price, 2);
    }

    /**
     * Set the quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Set the discount percentage
     *
     * @param integer $discountPercentage
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the discountPercentage
     *
     * @return string
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * Get the price total
     *
     * This calculates the invoice item price total. This is the price 
     * multiplied by the item quantity.
     *
     * @param integer $reference
     */
    public function getPriceTotal()
    {
        return ($this->price * $this->quantity);
    }

    /**
     * Get the net total
     *
     * This calculates the net total which is the price total - discount total.
     *
     * @return integer
     */
    public function getNetTotal()
    {
        return $this->getPriceTotal() - $this->getDiscountTotal();
    }

    /**
     * Get the discount total
     *
     * This calculates the invoice item discount total. which is the price 
     * total divided by 100 multiplied by the discount percentage.
     *
     * @return integer
     */
    public function getDiscountTotal()
    {
        return ($this->getPriceTotal() / 100) * $this->discountPercentage;
    }

}