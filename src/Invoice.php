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
use Rabus\Sinvoice\Basket;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\Totals;

/**
 * Invoice 
 * 
 * It would be a sin not to use this library!
 * 
 * This is the primary record in the library. All other models are developed
 * around this model.
 * 
 * Below are the main elements of an invoice:
 *  - Invoice
 *      - Items
 *          - The individual items the customer is purchasing
 *      - Charges
 *          - Additional charges you might with to apply to an invoice, 
 *          essentialy anything that is not an item but you need to charge for
 *      - Supplier
 *          - The entity issuing the invoice
 *      - Customer
 *          - The entity paying for the invoice
 *      - Shipping
 *          - The shipping details if required for the invoice
 *      - Recipient
 *          - The entity receiving the items on the invoice
 *      - Totals
 *          - The automatically calculated totals for the invoice
 * 
 * This model can be an invoice or you can use it as a shopping basket as well.
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
    public $supplier = Null;
    
    /**
     * @var object $customer is an instance of the Entity model. The customer
     * is receiving the invoice from the supplier.
     */
    public $customer = Null;

    /**
     * @var object $shipping is an instance of the Shipping model. if the 
     * item is being delivered/shipped then you should complete this.
     * 
     * The shipping default is null. If there is no delivery then you do not 
     * need to fill in the shipping.
     */
    public $shipping = Null;

    /**
     * @var object $discount is an object that adheres to the discount 
     * interface.
     */
    public $discount = Null;
    
    /**
     * @var object $totals is an instance of the Totals model.
     */
    public $totals;

    /**
     * @var array $items Is an instance of the Basket model. Items are the 
     * items that are being sold to your customer
     */
    public $items;

    /**
     * @var array $charges is an instance of the Basket model. Charges can be
     * an charge you need to make to a customer that are not an item.
     */
    public $charges;

    /**
     * Construct
     *
     * Constructs the invoice and set some default values
     * 
     * @return object $this An instance of the Invoice for the fluid interface.
     */
    public function __construct()
    { 
        $this->totals = new Totals();
        $this->items = new Basket($this);
        $this->charges = new Basket($this);
        
        return $this;
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
     * Remove the supplier
     *
     * @return object $this An instance of the Invoice.
     */
    public function removeSupplier()
    {
        $this->supplier = Null;

        return $this;
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
        if ($this->customer == Null) {
            return 'No customer set';
        }
        return $this->customer->formatToString();
    }

    /**
     * Remove the customer
     *
     * @return object $this An instance of the Invoice.
     */
    public function removeCustomer()
    {
        $this->customer = Null;

        return $this;
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

    /**
     * Remove the shipping
     *
     * @return object $this An instance of the Invoice.
     */
    public function removeShipping()
    {
        $this->shipping = Null;

        return $this;
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

    /**
     * Calculate the totals
     * 
     * This will calculate the totals via the total model.
     */
    public function calculateTotals()
    {
        $this->totals->calculateTotals($this);
    }

    /**
     * Get the totals
     */
    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * Add an item
     * 
     * @param object $item An instance of the Item model.
     * @return object $this.
     */
    public function addItem(Item $item)
    {
        $this->items->addItem($item);

        return $this;
    }

    /**
     * Update
     * 
     * This is run everytime the items basket and the charge baskets get 
     * updated via the obsever subject pattern.
     */
    public function update()
    {
        $this->calculateTotals();
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