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
        $percentageDiscount = new PercentageDiscount();
        $this->assertTrue(is_object($percentageDiscount));
        unset($percentageDiscount);
    }

    /**
     * Test the calculate function.
     */
    public function testCalculate()
    {  
        $percentageDiscount = new PercentageDiscount();
        $percentageDiscount->setFigure(10);
        $this->assertEquals($percentageDiscount->calculate(200.00), 20.00);
        unset($percentageDiscount);
    }

    /**
     * Test the setFigure and getFigure function.
     */
    public function testSetGetFigure()
    {  
        $percentageDiscount = new PercentageDiscount();
        $percentageDiscount->setFigure(10.00);
        $this->assertEquals($percentageDiscount->getFigure(), 10.00);
        unset($percentageDiscount);
    }

    /**
     * Test the setDescription and getDescription function.
     */
    public function testSetGetDescription()
    {  
        $percentageDiscount = new PercentageDiscount();
        $percentageDiscount->setDescription('10% discount');
        $this->assertEquals($percentageDiscount->getDescription(), '10% discount');
        unset($percentageDiscount);
    }
}