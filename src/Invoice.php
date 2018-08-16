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

use \DateTime;
use Rabus\Sinvoice\Observer;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\Totals;

/**
 * Invoice 
 * 
 * @TODO add the observer pattern for the items
 *  - Look at the example here:
 *      - http://php.net/manual/en/class.splobserver.php
 * 
 * So invoice is the reader of the notification
 * Basket is the sender/newspaper of the notificaiton
 *  - When basket gets updated it triggers ss
 * 
 * This is the primary model in the Sinvoice package, the invoice model.
 * 
 * The following are the various parts of the invoice model:
 *  - Number
 *      - The unique invoice number
 *  - Dates
 *      - The invoice can hold created, issued and due dates
 *  - Reference
 *      - Set a unique reference for the invoice. This might be a department
 *      code for the invoice
 *  - Tax
 *      - The tax is set via a percentage
 *  - Entities
 *      - The invoice holds the entities associatted with the invoice:
 *          - Supplier
 *          - Customer
 *          - Recipient
 *  - Totals
 *      - TODO needs editing
 *  - Item
 * All the entities are added to the invoice by their respective methods. The 
 * invoice also holds items, which are added by their respective method.
 *
 * @author RABUS rabus@art-by-rab.com
 */
class Invoice implements Observer 
{
    /**
     * @var string $number Is the invoice number.
     */
    private $number;

    /**
     * @var string $createdDate Is the date the invoice is created.
     */
    private $createdDate;

    /**
     * @var string $issuedDate Is the date the invoice is issued to the
     * customer.
     */
    private $issuedDate;
    
    /**
     * @var string $dueDate Is the date the invoice is due. Typically a due
     * date would be 14 or 21 days after the created date.
     */
    private $dueDate;

    /**
     * @var string $reference Is a reference you can apply for a specific
     * customer need. For example if your invoice is going to a specific 
     * department of a company, then you might need to provide them a 
     * reference.
     */
    private $reference;

    /**
     * @var integer $taxPercentage The tax percentage is dependant on the 
     * country you are creating the invoices for. For example in the United
     * Kingdom as of 2018 this would be 20% VAT.
     */
    private $taxPercentage;

    /**
     * @var object $supplier is an instance of the Entity model. The supplier 
     * is providing the invoice to the customer.
     */
    public $supplier;
    
    /**
     * @var object $customer is an instance of the Entity model. The customer
     * is receiving the invoice from the supplier.
     */
    public $customer;

    /**
     * @var object $shipping is an instance of the Shipping model. if the 
     * item is being delivered/shipped then you should complete this.
     * 
     * The shipping default is null. If there is no delivery then you do not 
     * need to fill in the shipping.
     */
    public $shipping = null;

    /**
     * @var object $discount is an object that adheres to the discount 
     * interface.
     */
    public $discount = null;
    
    /**
     * @var object $totals is an instance of the Totals model.
     */
    public $totals;

    /**
     * @var array $items Is an array if Item models.
     */
    private $items = array();

    /**
     * Construct
     *
     * Constructs the invoice and set some default values
     * 
     * @param integer $taxPercentage Is the default tax percentage you wish 
     * to use in your invoice.
     * @return object $this An instance of the Invoice for the fluid interface.
     */
    public function __construct()
    { 
        $this->setDefaultDates();
        $this->totals = new Totals();

        return $this;
    }

    /**
     * Add supplier
     * 
     * @param integer $customer is an instance of the Entity model.
     * @return object $this An instance of the Invoice.
     */
    public function addSupplier(Entity $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get the supplier
     *
     * @return string
     */
    public function getSupplier()
    {
        if (empty($this->supplier)) {
            return 'No supplier set';
        }
        return $this->supplier->formatToString();
    }


    /**
     * Add customer
     * 
     * @param integer $customer is an instance of the Entity model.
     * @return object $this An instance of the Invoice.
     */
    public function addCustomer(Entity $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get the customer
     *
     * @return string
     */
    public function getCustomer()
    {
        if (empty($this->customer)) {
            return 'No customer set';
        }
        return $this->customer->formatToString();
    }

    /**
     * Add shipping
     * 
     * After the shipping is added the totals need recalculating.
     * 
     * @param integer $shipping is an instance of the Shipping model.
     * @return object $this An instance of the Invoice.
     */
    public function addShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;

        $this->calculateTotals();

        return $this;
    }

    // @TODO do i need to add a remove shipping - RAB
    // @TODO the totals will need recalculating too.

    /**
     * Set Default Dates
     * 
     * @TODO consider adding this in the InvoiceFactory model - RAB
     *
     * This will set some default dates that can be overridden if required.
     */
    private function setDefaultDates()
    {
        $this->setCreatedDate('today');
        $this->setIssuedDate('today');
        $this->setDueDate('+ 14 days');
    }

    /**
     * Set number
     * 
     * @param integer $number Is the Invoice number
     * @return object $this An instance of the Invoice.
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set created date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * 'Today'
     * @return object $this An instance of the Invoice.
     */
    public function setCreatedDate($date)
    {
        $date = new DateTime($date);

        $this->createdDate = $date->format('Y-m-d');

        return $this;
    }

    /**
     * Get the createdDate
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set issued date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * 'Today'
     * @return object $this An instance of the Invoice.
     */
    public function setIssuedDate($date)
    {
        $date = new DateTime($date);

        $this->issuedDate = $date->format('Y-m-d');

        return $this;
    }

    /**
     * Get the issuedDate
     *
     * @return integer
     */
    public function getIssuedDate()
    {
        return $this->issuedDate;
    }

    /**
     * Set due date
     * 
     * @param string $date is the date in php DateTime format, for example, 
     * '+14 days'
     * @return object $this An instance of the Invoice.
     */
    public function setDueDate($date)
    {
        $date = new DateTime($date);

        $this->dueDate = $date->format('Y-m-d');

        return $this;
    }

    /**
     * Get the dueDate
     *
     * @return integer
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set reference
     * 
     * @param string $reference 
     * @return object $this An instance of the Invoice.
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set tax Percentage
     * 
     * The tax is set at invoice level rather than item level.
     * 
     * @param integer $percentage Is the tax percentage on the invoice, it 
     * should be an integer or decimal format. For example for 20% you would 
     * pass '20' or '20.00'.
     * @return object $this An instance of the Invoice.
     */
    public function setTaxPercentage($percentage)
    {
        $this->taxPercentage = round($percentage, 2);

        return $this;
    }

    /**
     * Get the tax percentage
     *
     * @return integer
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
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
     * After the discount is added the totals are always recalculated.
     *
     * @param object $discountModel Is a model that implements the 
     * DiscountInterface model.
     * @return object $this An instance of the Invoice.
     */
    public function addDiscount($discount)
    {
        $this->discount = $discount;

        $this->calculateTotals();

        return $this;
    }

    /**
     * Remove the discount
     *
     * @return integer
     */
    public function removeDiscount()
    {
        $this->discount = null;

        $this->calculateTotals();
    }

    /**
     * Get the discount
     * 
     * This will use the discount models calculate function to get the 
     * discount total.
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->totals->getDiscount();
    }

    public function calculateTotals()
    {
        $this->totals->calculateTotals($this);
    }

    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * Add an item to the basket
     *
     * @param object $item is an Item object being added to the items array.
     */
    public function addItem(Item $item)
    {
        array_push($this->items, $item);
        $this->calculateTotals();
    }

    /**
     * Remove an item from the basket by its key.
     *
     * @param int $key is the invoice items key
     */
    public function removeItem($key)
    {
        unset($this->items[$key]);
        $this->calculateTotals();
    }

    /**
     * Get the current items in the basket
     *
     * @return array An array of Item models.
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Clear all the current items
     */
    public function clearItems()
    {
        $this->items = array();
        $this->totals->setDefaultTotals();
    }

    /**
     * Has discount
     * 
     * Does the invoice have a discount? This will help when rendering the 
     * invoice as you will need to know if you should disply a discount.
     * 
     * @return boolean
     */
    public function hasDiscount()
    {
        if ($this->discount !== null) {
            return True;
        }

        return False;
    }

    /**
     * Has item discount
     * 
     * Does the invoice have any items that have a discount. This will help 
     * when rendering the invoice items as you will need to know if you should
     * display a discount column.
     * 
     * @return boolean
     */
    public function hasItemDiscount()
    {
        if ($this->totals->getItemDiscountTotal()) {
            return True;
        }

        return False;
    }
}