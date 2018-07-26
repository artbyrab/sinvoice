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
use Rabus\Sinvoice\Item;

/**
 * Sinvoice - Superb Invoice
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
class InvoiceOld {

    /**
     * @var string $number Is the invoice number. For legal reasons a invoice 
     * needs to have a number but of course this can be a mix of numbers and 
     * letters.
     */
    private $number;

    /**
     * @var string $createdDate Is the date the invoice is created.
     */
    private $createdDate;

    /**
     * @var string $issuedDate Is the date the invoice is issued to the
     * customer. By default this will be set as the created date and can be
     * overwritten if needed.
     */
    private $issuedDate;

    /**
     * @var string $dueDate Is the date the invoice is due. Typically a due
     * date would be 14 or 21 days after the created date.
     */
    private $dueDate;

    /**
     * @var string $shippingDate Is the date the invoice is due to be shipped.
     */
    private $shippingDate;

    /**
     * @var string $reference In some cases you may use a customer reference 
     * on an invoice. For example if a company seperates invoices by department
     * then they might have a unique reference for that deptartment.
     */
    private $reference;

    /**
     * @var integer $taxPercentage The tax percentage is dependant on the 
     * country you are creating the invoices for. For example in the United
     * Kingdom as of 2018 this would be 20% VAT.
     */
    private $taxPercentage;

    /**
     * @var integer $itemDiscountItemTotal Is:
     *  - All the item discounts 
     * 
     * We might never use this when displaying an invoice, however when we are 
     * displaying an invoice in a view, we need to know the total to determine
     * whether to show a discount columb on the item section.
     */
    private $itemDiscountTotal;

    /**
     * @var integer $netTotal Is:
     *  - the item net total
     *  - plus shipping and handling total
     *  - plus other charges total
     */
    private $netTotal;

    /**
     * @var integer $taxTotal Is:
     *  - The item net total divided by 100 and then multiplied by the tax 
     * percentage
     */
    private $taxTotal;

    /**
     * @var integer $shippingHandlingTotal Is the ...
     */
    private $shippingHandlingTotal;

    /**
     * @var integer $otherChargesDescription Is the ...
     */
    private $otherChargesDescription;

    /**
     * @var integer $otherChargesTotal Is the ...
     */
    private $otherChargesTotal;

    /**
     * @var integer $discount Is an invoice level discount. Let's say you are
     * already giving individual discount on your items and you need to offer
     * your customer a flat invoice level discount.
     * 
     * This Is the discount as an integer value, for example '5.00' or '10.00'. 
     * 
     * You can set the discount as a integer value using the setDiscount() 
     * function. Or, you can set the discount from a percentage value using the 
     * setDiscountFromPercentage() function. Both populate this field.
     */
    private $discount;

    /**
     * @var integer $discountTotal is:
     *  - discount 
     *  - plus item discount total
     * 
     * This is really only here for admin functionality. Let's say you want to
     * work out the average total discount on an invoice at item and invoice 
     * level then this will help.
     */
    private $discountTotal;

    /**
     * @var integer $grossTotal Is grossTotal due from the customer. The 
     * gross total is:
     *  - item net total 
     *  - plus the tax total 
     */
    private $grossTotal;

    /**
     * @var string $items Is an array if Item models.
     */
    private $items = array();
 
    /**
     * Construct
     *
     * Constructs the invoice and set some default values
     * 
     * @param integer $taxPercentage Is the default tax percentage you wish 
     * to use in your invoice.
     */
    public function __construct($taxPercentage=20.00)
    {
        $this->setDefaultDates();
        $this->setDefaultTotals();
        $this->setTaxPercentage($taxPercentage);
    }

    /**
     * Set number
     * 
     * @param integer $number Is the Invoice number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Set created date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * 'Today'
     */
    public function setCreatedDate($date)
    {
        $date = new DateTime($date);

        $this->createdDate = $date->format('Y-m-d');
    }

    /**
     * Set issued date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * 'Today'
     */
    public function setIssuedDate($date)
    {
        $date = new DateTime($date);

        $this->issuedDate = $date->format('Y-m-d');
    }

    /**
     * Set due date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * '+15 days'
     */
    public function setDueDate($date)
    {
        $date = new DateTime($date);

        $this->dueDate = $date->format('Y-m-d');
    }

    /**
     * Set shipping date
     * 
     * @param integer $date is the date in php DateTime format, for example, 
     * '+15 days'
     */
    public function setShippingDate($date)
    {
        $date = new DateTime($date);

        $this->shippingDate = $date->format('Y-m-d');
    }

    /**
     * Set the reference
     * 
     * @param integer $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Set the supplier
     * 
     * @param integer $supplier
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Set the customer account number
     * 
     * @param integer $customerAccountNumber
     */
    public function setCustomerAccountNumber($customerAccountNumber)
    {
        $this->customerAccountNumber = $customerAccountNumber;
    }

    /**
     * Set the customer 
     * 
     * The customer is typically:
     *  - Customer name
     *  - Customer address(billing address)
     *  - Customer email address/phone number
     * 
     * If you have your customer fields in seperate fields simply merge them 
     * into one string before passing to this function.
     * 
     * @param string $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Set the customer shipping address
     * 
     * If the customer has a specific shipping address which is different from
     * their billing address then you can set that here.
     * 
     * @param integer $customerShippingAddress
     */
    public function setCustomerShippingAddress($customerShippingAddress)
    {
        $this->customerShippingAddress = $customerShippingAddress;
    }

    /**
     * Set tax Percentage
     * 
     * The tax is set at invoice level rather than item level.
     * 
     * @param integer $percentage Is the tax percentage on the invoice, it 
     * should be an integer or decimal format. For example for 20% you would 
     * pass '20' or '20.00'.
     */
    public function setTaxPercentage($percentage)
    {
        $this->taxPercentage = round($percentage, 2);
    }

    /**
     * Set the shipping and handling total
     * 
     * @param integer $shippingHandlingTotal
     */
    public function setShippingHandlingTotal($shippingHandlingTotal)
    {
        $this->shippingHandlingTotal = round($shippingHandlingTotal, 2);
    }

    /**
     * Set the other charges description
     * 
     * @param string $otherChargesTotal
     */
    public function setOtherChargesDescription($otherChargesDescription)
    {
        $this->otherChargesDescription = $otherChargesDescription;
    }

    /**
     * Set the other charges total
     * 
     * @param integer $otherChargesTotal
     */
    public function setOtherChargesTotal($otherChargesTotal)
    {
        $this->otherChargesTotal = round($otherChargesTotal, 2);
    }

    /**
     * Set the discount percentage
     * 
     * If you just want to set fixed value discount then use this function.
     *
     * @param integer $integer
     */
    public function setDiscount($integer)
    {
        $this->discount = round($integer, 2);
    }

    /**
     * Set the discount percentage from a percentage
     * 
     * If you want to calculate your discount figure from a percentage then
     * simply utilise this function.
     *
     * @param integer $percentage
     */
    public function setDiscountFromPercentage($percentage)
    {
        $this->discount = round(($this->getPriceTotal()/100) * $percentage, 2);
    }

    /**
     * Set Default Dates
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
     * Set Default Totals
     * 
     * This is used at object construction level but is also used when we have 
     * no items in the object and the totals are calculated.
     */
    private function setDefaultTotals()
    {
        $this->shippingHandlingTotal = 0.00;
        $this->otherChargesTotal = 0.00;
        $this->netTotal = 0.00;
        $this->taxTotal = 0.00;
        $this->grossTotal = 0.00;
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
     * After the item is added we will recalculate the totals.
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
     * The items will need to be iterated over when displaying them.
     *
     * @return array An array of Item models.
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Clear all the current items
     *
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
                $this->itemDiscountTotal = $this->itemDiscountTotal + $item->getDiscount(); 
                $this->netTotal = $this->netTotal + $item->getNetTotal(); 
                
            }

            $this->discountTotal = $this->discount + $this->itemDiscountTotal;
            $this->netTotal = $this->netTotal + $this->shippingHandlingTotal + $this->otherChargesTotal;
            $this->taxTotal = round(($this->netTotal/100) * $this->taxPercentage, 2);
            $this->grossTotal = $this->netTotal + $this->taxTotal;
        }
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
     * Get the createdDate
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
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
     * Get the dueDate
     *
     * @return integer
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Get the shippingDate
     *
     * @return integer
     */
    public function getShippingDate()
    {
        return $this->shippingDate;
    }

    /**
     * Get the reference
     *
     * @return integer
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get the supplier
     *
     * @return integer
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Get the customerAccountNumber
     *
     * @return integer
     */
    public function getCustomerAccountNumber()
    {
        return $this->customerAccountNumber;
    }

    /**
     * Get the customer
     *
     * @return integer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Get the customerShippingAddress
     *
     * @return integer
     */
    public function getCustomerShippingAddress()
    {
        return $this->customerShippingAddress;
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
     * Get the taxTotal
     *
     * @return integer
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * Get the shippingHandlingTotal
     *
     * @return integer
     */
    public function getShippingHandlingTotal()
    {
        return $this->shippingHandlingTotal;
    }

    /**
     * Get the otherChargesDescription
     *
     * @return integer
     */
    public function getOtherChargesDescription()
    {
        return $this->otherChargesDescription;
    }

    /**
     * Get the otherChargesTotal
     *
     * @return integer
     */
    public function getOtherChargesTotal()
    {
        return $this->otherChargesTotal;
    }

    /**
     * Get the discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Get the itemDiscountTotal
     *
     * @return integer
     */
    public function getItemDiscountTotal()
    {
        return $this->itemDiscountTotal;
    }

    /**
     * Get the netTotal
     *
     * @return integer
     */
    public function getNetTotal()
    {
        return $this->netTotal;
    }

    /**
     * Get the grossTotal
     *
     * @return integer
     */
    public function getGrossTotal()
    {
        return $this->grossTotal;
    }
}
