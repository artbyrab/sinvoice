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
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Customer;
use Rabus\Sinvoice\Supplier;
use Rabus\Sinvoice\Recipient;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\Totals;

/**
 * Sinvoice - Superb Invoice
 *
 * @author RABUS rabus@art-by-rab.com
 */
class Invoice 
{
    /**
     * @var string $number Is the invoice number.
     * 
     * If you are VAT registered in Europe you will likely need sequential 
     * invoice numbers.
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
     * @var object $totals is an instance of the Totals model.
     */
    public $totals;

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
    public function __construct()
    {
        
        $this->setDefaultDates();
        $this->setTaxPercentage($taxPercentage);
        $this->totals = new Totals();

        if ($taxPercentage == null) {
            $this->taxPercentage = 20.00;
        }
    }

    /**
     * Add customer
     * 
     * @param integer $customer is an instance of the Entity model.
     */
    public function addCustomer(Entity $customer)
    {
        $this->customer = $customer;
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
     * @param integer $shipping is an instance of the Shipping model.
     */
    public function addShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
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
     * Set number
     * 
     * @param integer $number Is the Invoice number
     */
    public function setNumber($number)
    {
        $this->number = $number;
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
     */
    public function setCreatedDate($date)
    {
        $date = new DateTime($date);

        $this->createdDate = $date->format('Y-m-d');
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
     */
    public function setIssuedDate($date)
    {
        $date = new DateTime($date);

        $this->issuedDate = $date->format('Y-m-d');
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
     * @param integer $date is the date in php DateTime format, for example, 
     * '+15 days'
     */
    public function setDueDate($date)
    {
        $date = new DateTime($date);

        $this->dueDate = $date->format('Y-m-d');
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
     */
    public function setReference($reference)
    {
        $this->dueDate = $reference;
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
     */
    public function setTaxPercentage($percentage)
    {
        $this->taxPercentage = round($percentage, 2);
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
}