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
 * Items are the purchases your customers are making. The item could be a 
 * digital item like a product license key or physical item like a pair of 
 * shoes.
 * 
 * Items are attached/removed from invoice and this will trigger an update of 
 * the totals via the Basket model which is used to hold the items.
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
     * @var object $discount is a object that implements the 
     * DiscountInterface model.
     */
    public $discount;

    /**
     * @var string $code Is the code or reference of the items
     */
    public $code;

    /**
     * Construct
     * 
     * @return object $this An instance of the Item for the fluid interface.
     */
    public function __construct() 
    {    
        return $this;
    }

    /**
     * Set the name
     *
     * @param string $name
     * @return object $this An instance of the Item.
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set the description
     *
     * @param string $description
     * @return object $this An instance of the Item.
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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
     * Set the price
     *
     * We will ensure the price is rounded
     *
     * @param integer $price
     * @return object $this An instance of the Item.
     */
    public function setPrice($price)
    {
        $this->price = round($price, 2);

        return $this;
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
     * Set the quantity
     *
     * @param integer $quantity
     * @return object $this An instance of the Item.
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
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
     * Add the discount
     * 
     * You set the discount by adding a model that implements the 
     * DiscountInterface model.
     * 
     * This allows you to use various different discount models like flat 
     * discount or a percentage discount.
     *
     * @param object $discountModel Is a model that implements the 
     * DiscountInterface model.
     * @return object $this An instance of the Item.
     */
    public function addDiscount($discount)
    {
        $this->discount = $discount;
        
        return $this;
    }

    /**
     * Get the discount
     * 
     * This will use the discount models calculate function to get the 
     * discount total.
     *
     * @return mixed
     */
    public function getDiscount()
    {
        if (!empty($this->discount)){
            return $this->discount->calculate($this->getPriceTotal());
        }

        return Null;
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
        return $this->getPriceTotal() - $this->getDiscount();
    }
}