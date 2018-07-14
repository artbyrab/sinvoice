<?php 

use PHPUnit\Framework\TestCase;

/**
 * Sinvoice Invoice Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter InvoiceTest tests/InvoiceTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct InvoiceTest tests/InvoiceTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author RABUSH
 */
class InvoiceTest extends TestCase
{
    /**
     * @var object An instance of the Invoice model.
     */
    private $invoice;
    
    /**
     * @var object An instance of the Item model.
     */
    private $itemA;
    
    /**
     * @var object An instance of the Item model.
     */
    private $itemB;

    /**
     * Set up
     *
     * Performed before every test.
     * 
     * For the invoice tests we will set up a dummy invoice and two invoice
     * items that we can use in the invoice tests. This stops us having to 
     * instantitate and unset in each individual test. However for readability
     * i will likely only use this in large tests.
     */
    protected function setUp()
    {
        $this->invoice = new Rabus\Sinvoice\Invoice();
        $this->invoice->setNumber('1');
        $this->invoice->setCreatedDate('today');
        $this->invoice->setIssuedDate('today');
        $this->invoice->setDueDate('+14 days');
        $this->invoice->setShippingDate('today');
        $this->invoice->setReference('fc_1');
        $this->invoice->setSupplier('Frank Castle, 1 Park Street, New York.');
        $this->invoice->setCustomerAccountNumber('45983');
        $this->invoice->setCustomer('Billy Russo, 1 Lowland Avenue, New York');
        $this->invoice->setTaxPercentage(21);
        $this->invoice->setShippingHandlingTotal(9.00);
        $this->invoice->setOtherChargesDescription('Additional packing');
        $this->invoice->setOtherChargesTotal(7);

        $this->itemA = new Rabus\Sinvoice\Item();
        $this->itemA->setName('Black T-shirt');
        $this->itemA->setDescription('A wonderful black t-shirt in a washed out style.');
        $this->itemA->setPrice(20.00);
        $this->itemA->setQuantity(2);
        $this->itemA->setDiscountPercentage(5);

        $this->itemB = new Rabus\Sinvoice\Item();
        $this->itemB->setName('Black Cargo Pants');
        $this->itemB->setDescription('A beautiful pair of cargo pants.');
        $this->itemB->setPrice(25.00);
        $this->itemB->setQuantity(1);
        $this->itemB->setDiscountPercentage(0);
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {
        unset($this->invoice);
        unset($this->itemA);
        unset($this->itemB);   
    }
    /**
     * Test the Invoice creation
     *
     * This will simply test the invoice gets created correctly and the 
     * attributes are assigned correctly. 
     *
     */
    public function testIsThereAnySyntaxError()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $this->assertTrue(is_object($invoice));
        unset($invoice);
    }

    /**
     * Test the construction of the model
     *
     * This will ensure that any additional attributes get set
     * when the invoice is created.
     *
     */
    public function testConstruct()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $this->assertNotEmpty($invoice->getCreatedDate());
        $this->assertNotEmpty($invoice->getIssuedDate());
        $this->assertNotEmpty($invoice->getDueDate());
        $this->assertEquals($invoice->getItemSubTotal(), 0.00);
        $this->assertEquals($invoice->getItemDiscountTotal(), 0.00);
        $this->assertEquals($invoice->getTaxTotal(), 0.00);
        $this->assertEquals($invoice->getShippingHandlingTotal(), 0.00);
        $this->assertEquals($invoice->getOtherChargesTotal(), 0.00);
        $this->assertEquals($invoice->getTotal(), 0.00);
        $this->assertEquals($invoice->getTaxPercentage(), 20.00);
        unset($invoice);
    }

    /**
     * Test the setNumber function.
     */
    public function testSetNumber()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber('1');
        $this->assertEquals($invoice->getNumber(), '1');
        unset($invoice);
    }

    /**
     * Test the setCreatedDate function.
     */
    public function testSetCreatedDate()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $date = new DateTime('today');
        $invoice->setCreatedDate('today');
        $this->assertEquals($invoice->getCreatedDate(), $date->format('Y-m-d'));
        unset($invoice);
    }

    /**
     * Test the setIssuedDate function.
     */
    public function testSetIssuedDate()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $date = new DateTime('today');
        $invoice->setIssuedDate('today');
        $this->assertEquals($invoice->getIssuedDate(), $date->format('Y-m-d'));
        unset($invoice);
    }

    /**
     * Test the setDueDate function.
     */
    public function testSetDueDate()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $date = new DateTime('today');
        $invoice->setDueDate('today');
        $this->assertEquals($invoice->getDueDate(), $date->format('Y-m-d'));
        unset($invoice);
    }

    /**
     * Test the setShippingDate function.
     */
    public function testSetShippingDate()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $date = new DateTime('today');
        $invoice->setShippingDate('today');
        $this->assertEquals($invoice->getShippingDate(), $date->format('Y-m-d'));
        unset($invoice);
    }

    /**
     * Test the setReference function.
     */
    public function testSetReference()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setReference('customer:123');
        $this->assertEquals($invoice->getReference(), 'customer:123');
        unset($invoice);
    }

    /**
     * Test the setSupplier function.
     */
    public function testSetSupplier()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setSupplier('Frank Castle, 1 Park Street, New York.');
        $this->assertEquals($invoice->getSupplier(), 'Frank Castle, 1 Park Street, New York.');
        unset($invoice);
    }

    /**
     * Test the setCustomerAccountNumber function.
     */
    public function testSetCustomerAccountNumber()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setCustomerAccountNumber('Cust:123');
        $this->assertEquals($invoice->getCustomerAccountNumber(), 'Cust:123');
        unset($invoice);
    }

    /**
     * Test the setCustomer function.
     */
    public function testSetCustomer()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setCustomer('Billy Russo, 1 Lowland Avenue, New York');
        $this->assertEquals($invoice->getCustomer(), 'Billy Russo, 1 Lowland Avenue, New York');
        unset($invoice);
    }

    /**
     * Test the setTaxPercentage function.
     */
    public function testSetTaxPercentage()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setTaxPercentage(21);
        $this->assertEquals($invoice->getTaxPercentage(), 21.00);
        unset($invoice);
    }

    /**
     * Test the setShippingHandlingTotal function.
     */
    public function testSetShippingHandlingTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setShippingHandlingTotal(9.00);
        $this->assertEquals($invoice->getShippingHandlingTotal(), 9.00);
        unset($invoice);
    }

    /**
     * Test the setOtherChargesDescription function.
     */
    public function testSetOtherChargesDescription()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setOtherChargesDescription('Additional packing');
        $this->assertEquals($invoice->getOtherChargesDescription(), 'Additional packing');
        unset($invoice);
    }

    /**
     * Test the setOtherChargesTotal function.
     */
    public function testSetOtherChargesTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setOtherChargesTotal(7);
        $this->assertEquals($invoice->getOtherChargesTotal(), 7.00);
        unset($invoice);
    }

    /**
     * Test the addItem function.
     * 
     * Please note this test uses the setUp models.
     */
    public function testAddItem()
    {
        $this->invoice->addItem($this->itemA);
        $this->assertEquals(count($this->invoice->getItems()), 1);
        $this->assertEquals($this->invoice->getItems()[0]->getName(), 'Black T-shirt');
        $this->assertEquals($this->invoice->getItems()[0]->getDescription(), 'A wonderful black t-shirt in a washed out style.');
        $this->assertEquals($this->invoice->getItems()[0]->getPrice(), 20.00);
        $this->assertEquals($this->invoice->getItems()[0]->getQuantity(), 2);
    }

    /**
     * Test the removeItem function.
     * 
     * Please note this test uses the setUp models.
     */
    public function testremoveItem()
    {
        $this->invoice->addItem($this->itemA);
        $this->assertEquals(count($this->invoice->getItems()), 1);
        $this->invoice->removeItem(0);
        $this->assertEquals(count($this->invoice->getItems()), 0);
    }

    /**
     * Test the getItems function.
     *
     * Please note this test uses the setUp models.
     */
    public function testgetItems()
    {
        $this->invoice->addItem($this->itemA);
        $this->assertEquals(count($this->invoice->getItems()), 1);
    }

    /**
     * Test the clearItems function.
     * 
     * Please note this test uses the setUp models.
     */
    public function testclearItems()
    {
        $this->invoice->addItem($this->itemA);
        $this->invoice->addItem($this->itemB);
        $this->assertEquals(count($this->invoice->getItems()), 2);
        $this->invoice->clearItems();
        $this->assertEquals(count($this->invoice->getItems()), 0);
    }

    /**
     * Test the calculateTotals function.
     * 
     * Please note this test uses the setUp models.
     */
    public function testcalculateTotals()
    {
        $this->invoice->addItem($this->itemA);
        $this->invoice->calculateTotals();
        $this->assertEquals($this->invoice->getItemPriceTotal(), 40.00);
        $this->assertEquals($this->invoice->getItemDiscountTotal(), 2.00);
        $this->assertEquals($this->invoice->getItemSubTotal(), 38.00);
        $this->assertEquals($this->invoice->getTaxTotal(), 7.98);
        $this->assertEquals($this->invoice->getShippingHandlingTotal(), 0.00);
        $this->assertEquals($this->invoice->getOtherChargesTotal(), 0.00);
        $this->assertEquals($this->invoice->getTotal(), 45.98);
    }

    /**
     * Test the getItemSubTotal function.
     */
    public function testGetItemSubTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }

    /**
     * Test the getItemDiscountTotal function.
     */
    public function testgetItemDiscountTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }

    /**
     * Test the getTaxTotal function.
     */
    public function testgetTaxTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }

    /**
     * Test the getShippingHandlingTotal function.
     */
    public function testgetShippingHandlingTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }

    /**
     * Test the getOtherChargesTotal function.
     */
    public function testgetOtherChargesTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }
    /**
     * Test the getTotal function.
     */
    public function testgetTotal()
    {
        $invoice = new Rabus\Sinvoice\Invoice();
        $invoice->setNumber(7);
        $this->assertEquals($invoice->getNumber(), 7.00);
        unset($invoice);
    }

}
