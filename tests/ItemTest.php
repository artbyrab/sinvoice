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
    public $item;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->item = new Item();
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->item);
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
        $this->item->setName('Pilum Javelin');
        $this->assertEquals($this->item->getName(), 'Pilum Javelin');
    }

    /**
     * Test the Set and Get price functions
     */
    public function testSetGetPrice()
    {
        $this->item->setPrice(85.00);
        $this->assertEquals($this->item->getPrice(), 85.00);
    }

    /**
     * Test the Set and Get description functions
     */
    public function testSetGetDescription()
    {
        $this->item->setDescription('A fine javelin, suitable for throwing at retreating enemies.');
        $this->assertEquals($this->item->getDescription(), 'A fine javelin, suitable for throwing at retreating enemies.');
    }

    /**
     * Test the Set and Get quantity functions
     */
    public function testSetGetQuantity()
    {
        $this->item->setQuantity(2);
        $this->assertEquals($this->item->getQuantity(), 2);
    }

    /**
     * Test the Set and Get discont functions
     */
    public function testSetGetDiscount()
    {
        $this->item->setPrice(85.00);
        $this->item->setQuantity(1);
        $this->item->addDiscount(
            (new FlatDiscount())
                ->setFigure(15.00)
        );

        $this->assertEquals($this->item->getPriceTotal(), 85.00);
        $this->assertEquals($this->item->getNetTotal(), 70.00);
        $this->assertEquals($this->item->getDiscount(), 15.00);
    }
}
