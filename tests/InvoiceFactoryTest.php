<?php 

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\InvoiceFactory;
use artbyrab\sinvoice\Entity;
use artbyrab\sinvoice\Invoice;

/**
 * Sinvoice InvoiceFactory Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter InvoiceFactoryTest tests/InvoiceFactoryTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct InvoiceFactoryTest tests/InvoiceFactoryTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class InvoiceFactoryTest extends TestCase
{
    public $invoiceFactory;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->invoiceFactory = new InvoiceFactory();
        $this->invoiceFactory->addSupplier(
            (new Entity())
                ->setName('Emperor Nero')
                ->setAddress('Via Cavour, Rome, Italy')
                ->setPhone('01234 567891')
                ->setEmail('nero@rome.com')
                ->setReference('nero123')
        );
        $this->invoiceFactory->setTaxPercentage(10);
        $this->invoiceFactory->setIssuedDate('Today');
        $this->invoiceFactory->setDueDate('+21 days');
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->invoiceFactory);
    }

    /**
     * Test the buildInvoice function
     */
    public function testBuildInvoice()
    {
        $invoice = $this->invoiceFactory->buildInvoice();

        $this->assertTrue(is_object($invoice));
        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertInstanceOf(Entity::class, $invoice->supplier);

        $this->assertEquals($invoice->getTaxPercentage(), 10);
        
        $this->assertEquals($invoice->supplier->getName(), 'Emperor Nero');
        $this->assertEquals($invoice->supplier->getAddress(), 'Via Cavour, Rome, Italy');
        $this->assertEquals($invoice->supplier->getPhone(), '01234 567891');
        $this->assertEquals($invoice->supplier->getEmail(), 'nero@rome.com');
        $this->assertEquals($invoice->supplier->getReference(), 'nero123');

        $issuedDate = new DateTime('today');
        $this->assertEquals($invoice->getIssuedDate()->format('Y-m-d'), $issuedDate->format('Y-m-d'));

        $dueDate = new DateTime('+21 days');
        $this->assertEquals($invoice->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));

        unset($invoice);
    }

    /**
     * Test the buildInvoice function to error on no supplier
     */
    public function testBuildInvoiceErrorOnNoSupplier()
    {
        $invoiceFactory = new InvoiceFactory();
        $invoiceFactory->setTaxPercentage(10);
        $invoiceFactory->setIssuedDate('Today');
        $invoiceFactory->setDueDate('+21 days');

        // lets catch the error and assert it matches
        try {
            $result = $invoiceFactory->buildInvoice();
        } catch (\Exception $e) { 
            $this->assertEquals('The supplier and taxPercentage attributes need to be populated before you can build an invoice.', $e->getMessage());
        }

        unset($invoiceFactory);
    }

    /**
     * Test the buildInvoice function to error on no tax percentage
     */
    public function testBuildInvoiceErrorOnNoTaxPercentage()
    {
        $invoiceFactory = new InvoiceFactory();
        $invoiceFactory->addSupplier(
            (new Entity())
                ->setName('Emperor Nero')
                ->setAddress('Via Cavour, Rome, Italy')
                ->setPhone('01234 567891')
                ->setEmail('nero@rome.com')
                ->setReference('nero123')
        );
        
        $invoiceFactory->setIssuedDate('Today');
        $invoiceFactory->setDueDate('+21 days');

        // lets catch the error and assert it matches
        try {
            $result = $invoiceFactory->buildInvoice();
        } catch (\Exception $e) { 
            $this->assertEquals('The supplier and taxPercentage attributes need to be populated before you can build an invoice.', $e->getMessage());
        }

        unset($invoiceFactory);
    }

    /**
     * Test the addSupplier function
     */
    public function testAddSupplier()
    {
        $invoiceFactory = new InvoiceFactory();

        $invoiceFactory->addSupplier(
            (new Entity())
            ->setName('Emperor Nero')
            ->setAddress('Via Cavour, Rome, Italy')
            ->setPhone('01234 567891')
            ->setEmail('nero@rome.com')
            ->setReference('nero123')
        );

        $this->assertEquals($invoiceFactory->getSupplier()->getName(), 'Emperor Nero');
        $this->assertEquals($invoiceFactory->getSupplier()->getAddress(), 'Via Cavour, Rome, Italy');
        $this->assertEquals($invoiceFactory->getSupplier()->getPhone(), '01234 567891');
        $this->assertEquals($invoiceFactory->getSupplier()->getEmail(), 'nero@rome.com');
        $this->assertEquals($invoiceFactory->getSupplier()->getReference(), 'nero123');
        unset($invoiceFactory);
    }

    /**
     * Test the Set and Get tax percentage functions
     */
    public function testSetGetTaxPercentage()
    {
        $invoiceFactory = new InvoiceFactory();
        $invoiceFactory->setTaxPercentage(17);
        $this->assertEquals($invoiceFactory->getTaxPercentage(), 17);
        unset($invoiceFactory);
    }

    /**
     * Test the Set and Get Issued Date functions
     */
    public function testSetGetIssuedDate()
    {

        $issuedDate = new DateTime('today');

        $invoiceFactory = new InvoiceFactory();
        $invoiceFactory->setIssuedDate('Today');
        $this->assertEquals($invoiceFactory->getIssuedDate()->format('Y-m-d'), $issuedDate->format('Y-m-d'));
        unset($invoiceFactory);
    }

    /**
     * Test the Set and Get Due Date functions
     */
    public function testSetGetDueDate()
    {
        $dueDate = new DateTime('+21 days');

        $invoiceFactory = new InvoiceFactory();
        $invoiceFactory->setDueDate('+21 days');
        $this->assertEquals($invoiceFactory->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));
        unset($invoiceFactory);
    }
}
