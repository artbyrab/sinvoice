<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Totals;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Invoice;

/**
 * Sinvoice Invoice Model Test
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

        $itemA = new Item(
            array(
                'name' => 'Tunic',
                'description' => 'A fine cotton tunic, suitable for the discerning Roman.',
                'price' => '12.50',
                'quantity' => '2',
                'discount' => '0',
            )
        );

        $itemB = new Item(
            array(
                'name' => 'Leather Sandals',
                'description' => 'A beautiful set of leather sandals perfect for wearing to the market.',
                'price' => '7.99',
                'quantity' => '1',
                'discount' => '1',
            )
        );

        $this->invoice->addItem($itemA);
        $this->invoice->addItem($itemB);

        

        // // $this->totals = new Totals();
        $this->invoice->totals->calculateTotals($this->invoice);

        print_r($this->invoice->getItems());
        print_r($this->invoice->totals);
        exit;
    }

    /**
     * Tear down
     *s
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->items);s
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
        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 31.99);    
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
        $this->assertEquals($this->invoice->totals->getShippingHandlingTotal(), 0.00);    
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
        $this->assertEquals($this->invoice->totals->getNetTotal(), 21.99);    
    }

    /**
     * Test the getTaxTotal function
     */
    public function testGetTaxTotal()
    {
        $this->assertEquals($this->invoice->totals->getTaxTotal(), 21.99);    
    }

    /**
     * Test the getGrossTotal function
     */
    public function testGetGrossTotal()
    {
        $this->assertEquals($this->invoice->totals->getGrossTotal(), 21.99);    
    }

    /**
     * Test the setDiscount function
     */
    public function testSetDiscount()
    {
   
    }

    /**
     * Test the setDiscountFromPercentage function
     */
    public function testSetDiscountFromPercentage()
    {    

    }

    /**
     * Test the setDefaultTotals function
     */
    public function testSetDefaultTotals()
    {  
        $totals = new Totals();
        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getDiscount(), 0.00);
        $this->assertEquals($this->invoice->totals->getItemDiscountTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getDiscountTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getShippingHandlingTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getOtherChargesTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getNetTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getTaxTotal(), 0.00);
        $this->assertEquals($this->invoice->totals->getGrossTotal(), 0.00);
        unset($totals);
    }

    /**
     * Test the calculateTotals function
     */
    public function testCalculateTotals()
    {
    
    }
}
