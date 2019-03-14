<?php 

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Item;
use artbyrab\sinvoice\Basket;
use artbyrab\sinvoice\ObserverSubjects;

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
        $this->invoice = new Invoice();
        $this->basket = new Basket($this->invoice);
        $this->itemA = (new Item())
            ->setName('Gladius Sword')
            ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
            ->setPrice(120.00)
            ->setQuantity(4);
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
     * Test the __construct function.
     */
    public function testConstruct()
    {
        
        $invoice = new Invoice();
        $observerKey = spl_object_hash($invoice);
        $basket = new Basket($invoice);

        $this->assertInstanceOf(ObserverSubjects::class, $basket->subjects);
        $this->assertInstanceOf(Invoice::class, $basket->subjects->observers[$observerKey]);
    }

    /**
     * Test the addItem function.
     */
    public function testAddItem()
    {
        $this->basket->addItem($this->itemA);
        $key = spl_object_hash($this->itemA);
        $this->assertEquals(count($this->basket->getItems()), 1);
        $this->assertEquals($this->basket->getItems()[$key]->getName(), 'Gladius Sword');
        $this->assertEquals($this->basket->getItems()[$key]->getDescription(), 'Very fine looking Gladius sword, suitable for decapitation or stabbing.');
        $this->assertEquals($this->basket->getItems()[$key]->getPrice(), 120.00);
        $this->assertEquals($this->basket->getItems()[$key]->getQuantity(), 4);
    }

    /**
     * Test the removeItem function.
     */
    public function testRemoveItem()
    {
        $this->basket->addItem($this->itemA);
        $this->basket->removeItem($this->itemA);
        $this->assertEquals(count($this->basket->getItems()), 0);
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