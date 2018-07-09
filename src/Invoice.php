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

use DateTime;
use Rabus\Sinvoice\Item;s

/**
 * Sinvoice - Superb Invoices
 * 
 * Why are you sending your customers invoices...? That is... Sinful! This 
 * isn't an invoice... this is a Sinvoice! 
 * 
 * Why did i call it Sinvoices, well, what else can you call an invoice 
 * package? It is truly a Superb Invoice's
 *
 * Sinvoices is designed to make it easy to create invoices and all their 
 * associatted items with relative ease.
 * 
 * In Sinvoices we will use the following terms:
 *  - Sinvoice
 *      - Much better than an invoice, do not let anyone tell you otherwise
 *  - Invoice
 *      - An invoice... just not quite as good as a Sinvoice
 *  - Supplier
 *      - The entity creating the invoice
 *  - Customer
 *      - The entity receiving the invoice, the billable party
 *  - Item
 *      - An item in an invoice
 *      - Items can hold various attributes like quantity and more
 *
 * @author RABUS rabus@art-by-rab.com
 */
class Invoice {

    /**
     * @var string $number Is the invoice number. For legal reasons a invoice 
     * needs to have a number but of course this can be a mix of numbers and 
     * letters.
     */
    public $number;

    /**
     * @var string $createdDate Is the date the invoice is created.
     */
    public $createdDate;

    /**
     * @var string $issuedDate Is the date the invoice is issued to the
     * customer. By default this will be set as the created date and can be
     * overwritten if needed.
     */
    public $issuedDate;

    /**
     * @var string $dueDate Is the date the invoice is due. Typically a due
     * date would be 14 or 21 days after the created date.
     */
    public $dueDate;

    /**
     * @var string $shippingDate Is the date the invoice is due to be shipped.
     */
    public $shippingDate;

    /**
     * @var string $reference In some cases you may use a customer reference 
     * on an invoice. For example if a company seperates invoices by department
     * then they might have a unique reference for that deptartment.
     */
    public $reference;

    /**
     * @var string $supplier In most cases you can put the supplier name, 
     * address, telephone number and email in one field. The reason i added it 
     * in one field is the complexity of the invoice model is reduced 
     * drastically and therefore i believe worth it.
     */
    public $supplier;

    /**
     * @var string $customerAccountNumber Is any reference you may want to use
     * to tie the invoice to a specific customer or regular customer.
     */
    public $customerAccountNumber;

    /**
     * @var string $customer In most cases you can put the customer name, 
     * address, telephone number and email in one field.
     */
    public $customer;

    /**
     * @var string $customerShippingAddress You can complete the shipping 
     * address here if the item is due to be sent to the customer.
     */
    public $customerShippingAddress = 'N/A';

    /**
     * @var string $subTotal Is the total of the items, before the discount
     */
    private $itemsTotal;

    /**
     * @var string $discountTotal Is the ...
     */
    private $discountTotal;

    /**
     * @var string $blah Is the ...
     */
    private $taxTotal;

    /**
     * @var string $shippingHandlingTotal Is the ...
     */
    private $shippingHandlingTotal;

    /**
     * @var string $otherChargesTotal Is the ...
     */
    private $otherChargesTotal;

    /**
     * @var string $total Is the ...
     */
    private $total;

    /**
     * @var string $items Is the ...
     */
    private $items = array();
 
    /**
     * Construct
     *
     * Constructs the invoice total and sets some default dates.
     */
    public function __construct()
    {
        $this->setDefaultDates();
        $this->setDefaultTotals();
    }

    /**
     * Set Display
     *
     * This wwill overide the default display model with the display model of
     * your choice. 
     */
    private function setDisplay($display)
    {
        $this->display = $display;
    }
    
    /**
     * Set Default Dates
     *
     * This will set some default dates that can be overridden if required.
     */
    private function setDefaultDates()
    {
        $createdDate = new DateTime('today');
        $issuedDate = new DateTime('today');
        $dueDate = new DateTime('+ 14 days');

        $this->createdDate = $createdDate->format('Y-m-d');
        $this->issuedDate = $issuedDate->format('Y-m-d');
        $this->dueDate = $dueDate->format('Y-m-d');
    }

    /**
     * Set Default Totals
     */
    private function setDefaultTotals()
    {
        $this->subTotal = 0.00;
        $this->discountTotal = 0.00;
        $this->taxTotal = 0.00;
        $this->shippingHandlingTotal = 0.00;
        $this->otherChargesTotal = 0.00;
        $this->total = 0.00;
    }

    /**
     * Add an item to the basket
     * 
     * After the item is added we will recalculate the totals.
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
     * Get the current items in the basket.
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
        $this->setDefaultTotals();
    }

    /**
     * Calculate total
     *
     * This calculates the total of the invoice for most of the total by 
     * iterating over the items stored and adding the results.
     */
    public function calculateTotals()
    {
        $this->setDefaultTotals();
        if (!empty($this->items)) {
            foreach ($this->items as $item){
                $this->taxTotal = $this->taxTotal + $item->getTaxTotal();
                $this->discountTotal = $this->discountTotal + $item->getDiscountTotal();
                $this->total = $this->total + $item->getTotal();
                $this->subTotal = $this->subTotal + $item->getSubTotal();
            }
        }

        $this->shippingHandlingTotal = round($this->shippingHandlingTotal)
        $this->total = round($this->total, 2);
        $this->taxTotal = round($this->taxTotal, 2);
        $this->discountTotal = round($this->discountTotal, 2);
        $this->subTotal = round($this->subTotal, 2);
    }

}
