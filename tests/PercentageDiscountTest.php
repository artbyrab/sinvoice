<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\PercentageDiscount;

/**
 * Sinvoice PercentageDiscount Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter PercentageDiscountTest tests/PercentageDiscountTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct PercentageDiscountTest tests/PercentageDiscountTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class PercentageDiscountTest extends TestCase
{
    public $percentageDiscount;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->percentageDiscount = new PercentageDiscount();
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->percentageDiscount);
    }

    /**
     * Test the construct function
     */
    public function testConstruct()
    {
        $this->assertTrue(is_object($this->percentageDiscount));
    }

    /**
     * Test the calculate function.
     */
    public function testCalculate()
    {  
        $this->percentageDiscount->setFigure(10);
        $this->assertEquals($this->percentageDiscount->calculate(200.00), 20.00);
    }

    /**
     * Test the setFigure and getFigure function.
     */
    public function testSetGetFigure()
    {  
        $this->percentageDiscount->setFigure(10.00);
        $this->assertEquals($this->percentageDiscount->getFigure(), 10.00);
    }

    /**
     * Test the setDescription and getDescription function.
     */
    public function testSetGetDescription()
    {  
        $this->percentageDiscount->setDescription('10% discount');
        $this->assertEquals($this->percentageDiscount->getDescription(), '10% discount');
    }
}