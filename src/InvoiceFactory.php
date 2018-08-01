

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
use Rabus\Sinvoice\Invoice;

/**
 * Invoice Factory
 * 
 * Q) What is this used for?
 * A) Essentialy it is like a config file without having one? It saves you 
 * haveing to populate data in the model which will likely stay the same.
 * 
 * Q) Say what?
 * A) Imagine your create all your invoices in your application from the same 
 * PHP file. It could be a model file, or a controller. And you simply create 
 * all your invoices there via the invoice factory.
 * 
 * Easily create invoices with some attributes already filled in. 
 * 
 * To use create your Factory in the file you are going to generate you invoices
 * from.
 * 
 * $invoiceFactory = new Rabus\Sinvoice\InvoiceFactory();
 * $invoiceFactory->setSupplier(
 *      New Entity(
 *          array(
 *              'name' => 'My supplier',
 *              'address' => '1 High Street...',
 * 
 *          )
 *      )
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
    public $supplier;
    public $taxPercentage;
    public $issuedDate = null;
    public $dueDate = null;

    public function buildInvoice()
    {
        if (!empty($this->supplier) or !empty($this->taxPercentage)) {
            throw new Exception('The supplier and taxPercentage attributes need to be populated before you can build an invoice.');
        }
        $invoice = new Invoice();
        $invoice->addSupplier($this->supplier);
        $invoice->addTaxPercentage($this->taxPercentage);

        if (!empty($this->dueDate)) {
            $invoice->setDueDate($this->dueDate);
        }

        if (!empty($this->issuedDate)) {
            $invoice->setIssuedDate($this->issuedDate);
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
     * '+14 days'
     */
    public function setDueDate($date)
    {
        $date = new DateTime($date);

        $this->dueDate = $date->format('Y-m-d');
    }
}