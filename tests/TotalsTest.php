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
    }

    /**
     * Tear down
     *
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
        $item = new Totals();
        $this->assertTrue(is_object($item));
        unset($item);
    }

    /**
     * Test the getItemNetTotal function
     */
    public function testGetItemNetTotal()
    {
        $this->assertEquals($this->invoice->totals->getItemNetTotal(), 21.99);    
    }
}
