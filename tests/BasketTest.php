<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Basket;

/**
 * Sinvoice Basket Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter BasketTest tests/BasketTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct BasketTest tests/BasketTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class BasketTest extends TestCase
{
    public $basket;
    public $invoice;
    public $itemA;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->basket = new Basket();
        $this->invoice = new Invoice();
        $this->itemA = (new Item())
            ->setName('Gladius Sword')
            ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
            ->setPrice(120.00)
            ->setQuantity(1);
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->basket);
        unset($this->invoice);
        unset($this->itemA);
    }

    /**
     * Test the attachInvoice function.
     */
    public function testAttachInvoice()
    {
        $this->basket->attachInvoice($this->invoice);

        $this->assertInstanceOf(Invoice::class, $this->basket->invoice);
    }

    /**
     * Test the detachInvoice function.
     */
    public function testDetachInvoice()
    {
        $this->basket->attachInvoice($this->invoice);
        $this->basket->detachInvoice();

        $this->assertNull($this->basket->invoice);
    }

    /**
     * Test the notifyInvoice function.
     */
    public function testNotifyInvoice()
    {
        // $this->basket->notifyInvoice();

        // @TODO add in test
    }

    /**
     * Test the addItem function.
     */
    public function testAddItem()
    {
        $this->basket->addItem($this->itemA);
        $this->assertEquals(count($this->basket->getItems()), 1);
        $this->assertEquals($this->basket->getItems()[0]->getName(), 'Gladius Sword');
        $this->assertEquals($this->basket->getItems()[0]->getDescription(), 'Very fine looking Gladius sword, suitable for decapitation or stabbing.');
        $this->assertEquals($this->basket->getItems()[0]->getPrice(), 120.00);
        $this->assertEquals($this->basket->getItems()[0]->getQuantity(), 1);
    }

    /**
     * Test the removeItem function.
     */
    public function testRemoveItem()
    {
        $this->basket->addItem($this->itemA);
        $this->basket->removeItem(0);
        
    }

    /**
     * Test the getItems function.
     */
    public function testGetItems()
    {
        $this->basket->addItem($this->itemA);
        $this->assertEquals(count($this->basket->getItems()), 1);
    }


    /**
     * Test the clearItems function.
     */
    public function testClearItems()
    {
        $this->basket->addItem($this->itemA);
        $this->basket->clearItems();
        $this->assertEquals(count($this->basket->getItems()), 0);
    }
}