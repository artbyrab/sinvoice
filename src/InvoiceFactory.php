<?php 
/**
 * Sinvoice an invoicing model.
 * 
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in 
 * this package.
 */

namespace Rabus\Sinvoice;

use \DateTime;
use Rabus\Sinvoice\Invoice;

/**
 * Invoice Factory
 * 
 * Easily create invoices with some attributes already filled in. 
 * 
 * Q) What is this used for?
 * A) Essentialy it is like a config file without having one? It saves you 
 * having to populate data in the model which will likely stay the same.
 * 
 * Q) Say what?
 * A) Imagine your create all your invoices in your application from the same 
 * PHP file. It could be a model file, or a controller. And you simply create 
 * all your invoices there via the invoice factory. 
 * 
 * To use create your Factory in the file you are going to generate you invoices
 * from.
 * 
 * $invoiceFactory = new Rabus\Sinvoice\InvoiceFactory();
 * $invoiceFactory->setSupplier(
 *      (New Entity)
 *      ->setName('Rome Suppliers')
 *      ->setAddress
 * );
 * 
 * Now set your invoice factory's attributes so you don't have to keep adding
 * them to each individual invoice.
 * 
 * $invoiceFactory->setTaxPercentage(20);
 * $invoiceFactory->setDueDate(+21);
 * 
 * Now you build you invoice from your invoice factory
 * 
 * $invoice = $invoiceFactory->build();
 * 
 * Now you can continue to create multiple new invoices without having to always
 * add the supplier or tax rate.
 *
 * @author RABUS rabus@art-by-rab.com
 */
class InvoiceFactory
{
    /**
     * @var object $supplier is an instance of the Entity model. The supplier 
     * is providing the invoice to the customer.
     */
    protected $supplier;

    /**
     * @var integer $taxPercentage The tax percentage is dependant on the 
     * country you are creating the invoices for. For example in the United
     * Kingdom as of 2018 this would be 20% VAT.
     */
    protected $taxPercentage;

    /**
     * @var string $issuedDate Is the date the invoice is issued to the
     * customer. In this case the issued date is a php DateTime format like 
     * 'Today' or '+2days'.
     */
    protected $issuedDate;

    /**
     * @var string $dueDate Is the date the invoice is due. Typically a due
     * date would be 14 or 21 days after the created date. In this case the
     * issued date is a php DateTime format like 'Today' or '+2days'.
     */
    protected $dueDate;

    /**
     * Build an invoice
     * 
     * After you have populated the required fields you can easily build an 
     * invoice by running this.
     *
     * @return object This can return an instance of the Invoice model.
     * @throws Exception If the supplier and tax percentage are not populated.
     */
    public function buildInvoice()
    {
        if (empty($this->supplier) or empty($this->taxPercentage)) {
            throw new \Exception('The supplier and taxPercentage attributes need to be populated before you can build an invoice.');
        }

        $invoice = new Invoice();
        $invoice->addSupplier($this->supplier);
        $invoice->setTaxPercentage($this->taxPercentage);
        if (!empty($this->dueDate)) {
            $invoice->setDueDate($this->GetDueDate()->format('Y-m-d'));
        }
        if (!empty($this->issuedDate)) {
            $invoice->setIssuedDate($this->getIssuedDate()->format('Y-m-d'));
        }
        
        return $invoice;
    }

    /**
     * Add supplier
     * 
     * @param integer $customer is an instance of the Entity model.
     */
    public function addSupplier(Entity $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get the supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
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
     * Set issued date
     * 
     * @param string $date is the date in php DateTime format, for example, 
     * 'Today'
     */
    public function setIssuedDate($date)
    {
        $this->issuedDate = new DateTime($date);

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
     */
    public function setDueDate($date)
    {
        $this->dueDate = new DateTime($date);

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
}