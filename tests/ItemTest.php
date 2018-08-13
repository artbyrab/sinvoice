<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\FlatDiscount;

/**
 * Sinvoice Item Model Test
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
     * Test the construct with a fluid interface.
     */
    public function testConstructFluidInterface()
    {
        $item = (new Item())
            ->setName('Gladius Sword')
            ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
            ->setPrice(120.00)
            ->setQuantity(1);

        $this->assertTrue(is_object($item));
        $this->assertEquals($item->getName(), 'Gladius Sword');
        $this->assertEquals($item->getDescription(), 'Very fine looking Gladius sword, suitable for decapitation or stabbing.');
        $this->assertEquals($item->getPrice(), 120.00);
        $this->assertEquals($item->getQuantity(), 1);
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
        $item->setPrice(85.00);
        $item->setQuantity(1);
        $item->addDiscount(
            (new FlatDiscount())
                ->setFigure(15.00)
        );

        $this->assertEquals($item->getPriceTotal(), 85.00);
        $this->assertEquals($item->getNetTotal(), 70.00);
        $this->assertEquals($item->getDiscount(), 15.00);
    }
}
