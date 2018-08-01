<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Item;

/**
 * Sinvoice Invoice Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter ItemTest tests/ItemTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct ItemTest tests/ItemTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class ItemTest extends TestCase
{
    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
    
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
    }

    /**
     * Test the construct function
     */
    public function testConstruct()
    {
        $item = new Item();
        $this->assertTrue(is_object($item));
        unset($item);
    }

    /**
     * Test the construct function with paramater values.
     */
    public function testConstructWithParams()
    {
        $item = new Item(
            array(
                'name' => 'Gladius Sword',
                'description' => 'Very fine looking Gladius sword, suitable for decapitation or stabbing.',
                'price' => 120.00,
                'quantity' => 1,
                'discount' => 0,
            )
        );

        $this->assertTrue(is_object($item));
        $this->assertEquals($item->getName(), 'Gladius Sword');
        $this->assertEquals($item->getDescription(), 'Very fine looking Gladius sword, suitable for decapitation or stabbing.');
        $this->assertEquals($item->getPrice(), 120.00);
        $this->assertEquals($item->getQuantity(), 1);
        $this->assertEquals($item->getDiscount(), 0);
        unset($item);
    }

    /**
     * Test the Set and Get name functions
     */
    public function testSetGetName()
    {
        $item = new Item();
        $item->setName('Pilum Javelin');
        $this->assertEquals($item->getName(), 'Pilum Javelin');
        unset($item);
    }

    /**
     * Test the Set and Get price functions
     */
    public function testSetGetPrice()
    {
        $item = new Item();
        $item->setPrice(85.00);
        $this->assertEquals($item->getPrice(), 85.00);
        unset($item);
    }

    /**
     * Test the Set and Get description functions
     */
    public function testSetGetDescription()
    {
        $item = new Item();
        $item->setDescription('A fine javelin, suitable for throwing at retreating enemies.');
        $this->assertEquals($item->getDescription(), 'A fine javelin, suitable for throwing at retreating enemies.');
        unset($item);
    }

    /**
     * Test the Set and Get quantity functions
     */
    public function testSetGetQuantity()
    {
        $item = new Item();
        $item->setQuantity(2);
        $this->assertEquals($item->getQuantity(), 2);
        unset($item);
    }

    /**
     * Test the Set and Get discont functions
     */
    public function testSetGetDiscount()
    {
        $item = new Item();
        $item->setDiscount(10.00);
        $this->assertEquals($item->getDiscount(), 10.00);
        unset($item);
    }
}
