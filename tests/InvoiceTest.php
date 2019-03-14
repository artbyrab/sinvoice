<?php 

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Entity;
use artbyrab\sinvoice\Item;
use artbyrab\sinvoice\Totals;
use artbyrab\sinvoice\Basket;
use artbyrab\sinvoice\FlatDiscount;
use artbyrab\sinvoice\PercentageDiscount;
use artbyrab\sinvoice\Shipping;

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
 * @author artbyrabH
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
     * @var object An instance of the Entity model.
     */
    private $supplier;

    /**
     * @var object An instance of the Entity model.
     */
    private $customer;

    /**
     * @var object An instance of the Shipping model.
     */
    private $shipping;

    /**
     * Set up
     *
     * Performed before every test.
     * 
     * We will set up some seperate test items to use in the various tests here
     * by keeping them seperate here, we can easily attach and detach as 
     * needed.
     */
    protected function setUp()
    {
        $this->invoice = (new Invoice())
            ->setNumber('1')
            ->setCreatedDate('today')
            ->setIssuedDate('today')
            ->setDueDate('+14 days')
            ->setReference('rome_1')
            ->setTaxPercentage(20);
 
        $this->itemA = (new Item())
            ->setName('Black Tunic')
            ->setDescription('A wonderful black tunic to mark you out from the plebians.')
            ->setPrice(20.00)
            ->setQuantity(2);

        $this->itemB = (new Item())
            ->setName('Leather Sandals(Tan)')
            ->setDescription('A beautiful pair of leather sandals.')
            ->setPrice(25.00)
            ->setQuantity(1);

        $this->supplier = (new Entity())
            ->setName('Rome Suppliers')
            ->setAddress('1 Main Street, Industrial District, Rome, Italy')
            ->setPhone('01234 567899')
            ->setEmail('rsuppliers@rome.com')
            ->setReference('rsa');
        
        $this->customer = (new Entity())
            ->setName('Emperor Nero')
            ->setAddress('Via Cavour, Rome, Italy')
            ->setPhone('01234 567891')
            ->setEmail('nero@rome.com')
            ->setReference('nero123');

        $this->flatDiscount = (new FlatDiscount())
            ->setFigure(5)
            ->setDescription('5 flat discount');

        $this->shipping = (new Shipping())
            ->addRecipient((new Entity())
                ->setName('Ceasar')
                ->setAddress('1 High Street, Rome, Italy')
                ->setPhone('01245 678910')
                ->setEmail('ceasar@rome.com')
                ->setReference('a145')
            )
            ->setPrice(10.99)
            ->setDeliveryDate('+7 days')
            ->setHandler('Rome Road Mail')
            ->setReference('8547124');
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
        unset($this->supplier);
        unset($this->customer);
        unset($this->flatDiscount);
        unset($this->shipping);
    }

    /**
     * Test the __construct function
     */
    public function testConstruct()
    {
        $invoice = new Invoice();

        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertInstanceOf(Totals::class, $invoice->totals);
        $this->assertInstanceOf(Basket::class, $invoice->items);
        $this->assertInstanceOf(Basket::class, $invoice->charges);

        unset($invoice);
    }

    /**
     * Test the __construct function with a fluid interface
     *
     */
    public function testConstructWithFluidInterface()
    {
        $createdIssuedDate = new DateTime('today');
        $dueDate = new DateTime('+21 days');

        $invoice = (new Invoice())
            ->setNumber(1)
            ->setCreatedDate('Today')
            ->setIssuedDate('Today')
            ->setDueDate('+21 days')
            ->setReference('rome_1')
            ->setTaxPercentage(15.00);

        $this->assertEquals($invoice->getNumber(), '1');
        $this->assertEquals($invoice->getCreatedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getIssuedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));
        $this->assertEquals($invoice->getReference(), 'rome_1');
        $this->assertEquals($invoice->getTaxPercentage(), 15.00);

        unset($invoice);
    }

    /**
     * Test the __construct function with a fluid interface
     *
     */
    public function testConstructWithFluidInterfaceItems()
    {
        $createdIssuedDate = new DateTime('today');
        $dueDate = new DateTime('+21 days');

        $invoice = (new Invoice())
            ->setNumber(1)
            ->setCreatedDate('Today')
            ->setIssuedDate('Today')
            ->setDueDate('+21 days')
            ->setReference('rome_1')
            ->setTaxPercentage(15.00)
            ->addItem((new Item())
                ->setName('Gladius Sword')
                ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
                ->setPrice(120.00)
                ->setQuantity(1)
            )
            ->addItem((new Item())
                ->setName('Shield')
                ->setDescription('A shield, very useful in the tortoise.')
                ->setPrice(49.99)
                ->setQuantity(1)
                ->addDiscount(
                    (new PercentageDiscount())
                        ->setFigure(10.00)
                        ->setDescription('10% discount')
                )
            );

        $this->assertEquals($invoice->getNumber(), '1');
        $this->assertEquals($invoice->getCreatedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getIssuedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));
        $this->assertEquals($invoice->getReference(), 'rome_1');
        $this->assertEquals($invoice->getTaxPercentage(), 15.00);
        $this->assertEquals(count($invoice->items->getItems()), 2);

        unset($invoice);
    }

    /**
     * Test the __construct function with a fluid interface
     *
     */
    public function testConstructWithFluidInterfaceEntities()
    {
        $createdIssuedDate = new DateTime('today');
        $dueDate = new DateTime('+21 days');

        $invoice = (new Invoice())
            ->setNumber(1)
            ->setCreatedDate('Today')
            ->setIssuedDate('Today')
            ->setDueDate('+21 days')
            ->setReference('rome_1')
            ->setTaxPercentage(15.00)
            ->addSupplier((new Entity())
                ->setName('Rome Suppliers')
                ->setAddress('1 Main Street, Industrial District, Rome, Italy')
                ->setPhone('01234 567899')
                ->setEmail('rsuppliers@rome.com')
                ->setReference('rsa')
            )
            ->addCustomer((new Entity())
                ->setName('Emperor Nero')
                ->setAddress('Via Cavour, Rome, Italy')
                ->setPhone('01234 567891')
                ->setEmail('nero@rome.com')
                ->setReference('nero123')
        );

        $this->assertEquals($invoice->getNumber(), '1');
        $this->assertEquals($invoice->getCreatedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getIssuedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
        $this->assertEquals($invoice->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));
        $this->assertEquals($invoice->getReference(), 'rome_1');
        $this->assertEquals($invoice->getTaxPercentage(), 15.00);
        $this->assertInstanceOf(Entity::class, $invoice->supplier);
        $this->assertEquals($invoice->supplier->getName(), 'Rome Suppliers');
        $this->assertInstanceOf(Entity::class, $invoice->customer);
        $this->assertEquals($invoice->customer->getName(), 'Emperor Nero');

        unset($invoice);
    }

    /**
     * Test the set and get number functions
     *
     */
    public function testSetGetNumber()
    {
        $this->invoice->setNumber('#4145');
        $this->assertEquals($this->invoice->getNumber(), '#4145');
    }

    /**
     * Test the set and get created date functions
     *
     */
    public function testSetGetCreatedDate()
    {
        $createdIssuedDate = new DateTime('today');
        $this->invoice->setCreatedDate('Today');
        $this->assertEquals($this->invoice->getCreatedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
    }

    /**
     * Test the set and get issued date functions 
     *
     */
    public function testSetGetIssuedDate()
    {
        $createdIssuedDate = new DateTime('today');
        $this->invoice->setIssuedDate('Today');
        $this->assertEquals($this->invoice->getIssuedDate()->format('Y-m-d'), $createdIssuedDate->format('Y-m-d'));
    }

    /**
     * Test the ... function
     *
     */
    public function testSetGetDueDate()
    {
        $dueDate = new DateTime('+14 days');
        $this->invoice->setIssuedDate('+14 days');
        $this->assertEquals($this->invoice->getDueDate()->format('Y-m-d'), $dueDate->format('Y-m-d'));
    }

    /**
     * Test the ... function
     *
     */
    public function testSetGetReference()
    {
        $this->invoice->setReference('rome_1');
        $this->assertEquals($this->invoice->getReference(), 'rome_1');
    }

    /**
     * Test the ... function
     *
     */
    public function testSetGetTaxPercentage()
    {
        $this->invoice->setTaxPercentage(20.00);
        $this->assertEquals($this->invoice->getTaxPercentage(), 20.00);
    }

    /**
     * Test the addSupplier function
     *
     */
    public function testAddSupplier()
    {
        $this->invoice->addSupplier($this->supplier);
        $this->assertInstanceOf(Entity::class, $this->invoice->supplier);
        $this->assertEquals($this->invoice->supplier->getName(), 'Rome Suppliers');
    }

    /**
     * Test the getSupplier function
     *
     */
    public function testGetSupplier()
    {
        $this->invoice->addSupplier($this->supplier);
        $this->assertEquals(
            $this->invoice->getSupplier(), 
            'Rome Suppliers, 1 Main Street, Industrial District, Rome, Italy, 01234 567899, rsuppliers@rome.com, rsa'
        );
    }

    /**
     * Test the removeSupplier function
     *
     */
    public function testRemoveSupplier()
    {
        $this->invoice->addSupplier($this->supplier);
        $this->invoice->removeSupplier();
        $this->assertNull($this->invoice->supplier);
    }

    /**
     * Test the addCustomer function
     *
     */
    public function testAddCustomer()
    {
        $this->invoice->addCustomer($this->customer);
        $this->assertInstanceOf(Entity::class, $this->invoice->customer);
        $this->assertEquals($this->invoice->customer->getName(), 'Emperor Nero');
    }

    /**
     * Test the getCustomer function
     *
     */
    public function testGetCustomer()
    {
        $this->invoice->addCustomer($this->customer);
        $this->assertEquals(
            $this->invoice->getCustomer(), 
            'Emperor Nero, Via Cavour, Rome, Italy, 01234 567891, nero@rome.com, nero123'
        );
    }

    /**
     * Test the removeCustomer function
     *
     */
    public function testRemoveCustomer()
    {
        $this->invoice->addCustomer($this->customer);
        $this->invoice->removeCustomer();
        $this->assertNull($this->invoice->customer);
    }

    /**
     * Test the addShipping function
     *
     */
    public function testAddShipping()
    {
        $this->invoice->addShipping($this->shipping);
        $this->assertInstanceOf(Shipping::class, $this->invoice->shipping);
        $this->assertEquals($this->invoice->shipping->getPrice(), 10.99);
    }

    /**
     * Test the removeShipping function
     *
     */
    public function testRemoveShipping()
    {
        $this->invoice->addShipping($this->shipping);
        $this->invoice->removeShipping();
        $this->assertNull($this->invoice->shipping);
    }

    /**
     * Test the addDiscount function
     *
     */
    public function testAddDiscount()
    {
        $this->invoice->addDiscount($this->flatDiscount);
        $this->assertInstanceOf(FlatDiscount::class, $this->invoice->discount);
    }

    /**
     * Test the ... function
     *
     */
    public function testRemoveDiscount()
    {
        $this->invoice->addDiscount($this->flatDiscount);
        $this->assertInstanceOf(FlatDiscount::class, $this->invoice->discount);
    }

    /**
     * Test the getDiscount function
     *
     */
    public function testGetDiscount()
    {
        $this->invoice->addDiscount($this->flatDiscount);
        $this->assertEquals($this->invoice->getDiscount(), 0.0);
    }

    /**
     * Test the getDiscount function with an item attached to the invoice first.
     *
     */
    public function testGetDiscountWithDiscount()
    {
        $this->invoice->addDiscount($this->flatDiscount);
        $this->assertEquals($this->invoice->getDiscount(), 0.0);
    }

    /**
     * Test the calculateTotals function
     *
     */
    public function testCalculateTotals()
    {
        $this->invoice->addItem($this->itemA);
        $this->invoice->addItem($this->itemB);
        $this->invoice->calculateTotals();

        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 65.0);
        $this->assertEquals($this->invoice->totals->getDiscount(), 0.0);
        $this->assertEquals($this->invoice->totals->getItemDiscountTotal(), 0.0);
        $this->assertEquals($this->invoice->totals->getDiscountTotal(), 0.0);
        $this->assertEquals($this->invoice->totals->getShippingHandlingTotal(), 0.0);
        $this->assertEquals($this->invoice->totals->getOtherChargesTotal(), 0.0);
        $this->assertEquals($this->invoice->totals->getNetTotal(), 65.0);
        $this->assertEquals($this->invoice->totals->getTaxTotal(), 13.0);
        $this->assertEquals($this->invoice->totals->getGrossTotal(), 78.0);
    }

    /**
     * Test the update function
     *
     */
    public function testUpdate()
    {
        $this->invoice->addItem($this->itemA);
        $this->invoice->addItem($this->itemB);
        $this->invoice->update();

        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 65.0);
    }

    /**
     * Test the hasDiscount function
     *
     */
    public function testHasDiscountTrue()
    {
        $this->invoice->addDiscount($this->flatDiscount);
        $this->assertTrue($this->invoice->hasDiscount());
    }

    /**
     * Test the hasDiscount function
     *
     */
    public function testHasDiscountFalse()
    {
        $this->assertFalse($this->invoice->hasDiscount());
    }

    /**
     * Test the hasItemDiscount function
     *
     */
    public function testHasItemDiscountTrue()
    {
        $this->itemA->addDiscount($this->flatDiscount);
        $this->invoice->addItem($this->itemA);

        $this->assertTrue($this->invoice->hasItemDiscount());
    }

    /**
     * Test the hasItemDiscount function
     *
     */
    public function testHasItemDiscountFalse()
    {
        $this->assertFalse($this->invoice->hasItemDiscount());
    }

    /**
     * Test the hasDiscount function
     *
     */
    public function testHasShippingTrue()
    {
        $this->invoice->addShipping($this->shipping);
        $this->assertTrue($this->invoice->hasShipping());
    }

    /**
     * Test the hasDiscount function
     *
     */
    public function testHasShippingFalse()
    {
        $this->assertFalse($this->invoice->hasShipping());
    }

}