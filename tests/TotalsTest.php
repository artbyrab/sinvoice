<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Totals;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Shipping;

/**
 * Sinvoice Totals Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter TotalsTest tests/TotalsTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct TotalsTest tests/TotalsTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class TotalsTest extends TestCase
{
    private $invoice;
    private $items;
    private $totals;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->invoice = New Invoice();
        $this->invoice->setTaxPercentage(20.00);


        $itemA = (new Item())
            ->setName('Tunic')
            ->setDescription('A fine cotton tunic, suitable for the discerning Roman.')
            ->setPrice(10.50)
            ->setQuantity(2);

        $itemB = (new Item())
            ->setName('Leather Sandals')
            ->setDescription('A beautiful set of leather sandals perfect for wearing to the market.')
            ->setPrice(5.00)
            ->setQuantity(1);

        $this->invoice->addItem($itemA);
        $this->invoice->addItem($itemB);

        $this->invoice->addShipping((new Shipping)
            ->setPrice(10.00)
        );
    
    }

    /**
     * Tear down
     *s
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->items);
    }

    /**
     * Test the ... function
     */
    public function testConstruct()
    {
        $totals = new Totals();
        $this->assertTrue(is_object($totals));
        unset($totals);
    }

    /**
     * Test the getItemNetTotal function
     */
    public function testGetItemNetTotal()
    {
        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 26.00);    
    }

    /**
     * Test the getDiscount function
     */
    public function testGetDiscount()
    {
        $this->assertEquals($this->invoice->totals->getDiscount(), 0.00);    
    }

    /**
     * Test the getItemDiscountTotal function
     */
    public function testGetItemDiscountTotal()
    {
        $this->assertEquals($this->invoice->totals->getItemDiscountTotal(), 0.00);    
    }

    /**
     * Test the getDiscountTotal function
     */
    public function testGetDiscountTotal()
    {
        $this->assertEquals($this->invoice->totals->getDiscountTotal(), 0.00);    
    }

    /**
     * Test the getShippingHandlingTotal function
     */
    public function testGetShippingHandlingTotal()
    {
        $this->assertEquals($this->invoice->totals->getShippingHandlingTotal(), 10.00);    
    }

    /**
     * Test the getOtherChargesTotal function
     */
    public function testGetOtherChargesTotal()
    {
        $this->assertEquals($this->invoice->totals->getOtherChargesTotal(), 0.00);    
    }

    /**
     * Test the getNetTotal function
     */
    public function testGetNetTotal()
    {
        $this->assertEquals($this->invoice->totals->getNetTotal(), 36.00);    
    }

    /**
     * Test the getTaxTotal function
     */
    public function testGetTaxTotal()
    {
        $this->assertEquals($this->invoice->totals->getTaxTotal(), 7.20);    
    }

    /**
     * Test the getGrossTotal function
     */
    public function testGetGrossTotal()
    {
        $this->assertEquals($this->invoice->totals->getGrossTotal(), 43.20);    
    }

    /**
     * Test the setDefaultTotals function
     */
    public function testSetDefaultTotals()
    {  
        $totals = new Totals();
        $totals->setDefaultTotals();
        $this->assertEquals($totals->getItemNetTotal(), 0.00);
        $this->assertEquals($totals->getDiscount(), 0.00);
        $this->assertEquals($totals->getItemDiscountTotal(), 0.00);
        $this->assertEquals($totals->getDiscountTotal(), 0.00);
        $this->assertEquals($totals->getShippingHandlingTotal(), 0.00);
        $this->assertEquals($totals->getOtherChargesTotal(), 0.00);
        $this->assertEquals($totals->getNetTotal(), 0.00);
        $this->assertEquals($totals->getTaxTotal(), 0.00);
        $this->assertEquals($totals->getGrossTotal(), 0.00);
        unset($totals);
    }

    /**
     * Test the calculateTotals function
     */
    public function testCalculateTotals()
    {
        $invoice = New Invoice();
        $invoice->setTaxPercentage(20.00);

        $itemA = (new Item())
            ->setName('Roman Shield')
            ->setDescription('A solid Roman shield, perfect for battle.')
            ->setPrice(89.99)
            ->setQuantity(1);

        $itemB = (new Item())
            ->setName('Roman Gladius Sword')
            ->setDescription('A beautiful artisan sword, for the discerning Roman warrior.')
            ->setPrice(149.99)
            ->setQuantity(1);

        $invoice->addItem($itemA);
        $invoice->addItem($itemB);
    }
}
