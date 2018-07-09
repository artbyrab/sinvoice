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
    public $name;

    /**
     * @var string $description is the item description if needed. Default is 
     * automatically set.
     */
    public $description = 'N/A';

    /**
     * @var integer $price Is the price of the item in integer or decimal 
     * format, '20', or '21.99'.
     */
    public $price;

    /**
     * @var integer $quantity Is the number of items.
     */
    public $quantity;

    /**
     * @var integer $discountPercentage Is the discount you with to give on the
     * item in a percentage format. So if you wanted to give a 20% discount you 
     * would set it at '20'.
     */
    public $discountPercentage;

    /**
     * @var ...
     */
    public $taxPercentage;

    /**
     * Construct
     *
     * As well as contrusting the item we can set any default attribute values
     * we want to define.
     */
    public function __construct()
    {
        $this->setTaxPercentage(20);
    }

    /**
     * Set tax Percentage
     * 
     * The tax is set at item level, as some items may not require tax. If you 
     * need to overide the default tax simply set it after you initialise
     * the object.
     * 
     * @param integer $percentage Is the tax percentage for the item in integer
     * or decimal format. For example for 20% you would pass '20'.
     */
    private function setTaxPercentage($percentage)
    {
        $this->taxPercentage = $percentage;
    }

    /**
     * Get the price total
     *
     * This calculates the invoice item price total. This is the price 
     * multiplied by the item quantity.
     *
     * @return integer
     */
    public function getPriceTotal()
    {
        return ($this->price * $this->quantity);
    }

    /**
     * Get the sub total
     *
     * This calculates the sub total which is the price total - discount total.
     *
     * @return integer
     */
    public function getSubTotal()
    {
        return $this->getPriceTotal() - $this->getDiscountTotal();
    }

    /**
     * Get the VAT total
     *
     * This calculates the invoice item VAT total. This will divide the price 
     * total plus the discount total divided by 100 then multiply by the tax 
     * percentage.
     *
     * @return integer
     */
    public function getTaxTotal()
    {
        return ($this->getSubTotal() / 100) * $this->taxPercentage;
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

    /**
     * Get the total
     *
     * This calculates the invoice item total, which is the sub total plus the 
     * total tax.
     *
     * @return integer
     */
    public function getTotal()
    {
        return ($this->getSubTotal() + $this->getTaxTotal());
    }
}