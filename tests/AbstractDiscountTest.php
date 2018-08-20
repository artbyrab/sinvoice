<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\AbstractDiscount;

/**
 * Sinvoice AbstractDiscount Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter AbstractDiscountTest tests/AbstractDiscountTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct AbstractDiscountTest tests/AbstractDiscountTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class AbstractDiscountTest extends TestCase
{
    /**
     * Test the construct function
     */
    public function testConstruct()
    {
        $abstractDiscount = new AbstractDiscount();
        $this->assertTrue(is_object($abstractDiscount));
        unset($abstractDiscount);
    }

    /**
     * Test the calculate function.
     */
    public function testCalculate()
    {  
        $abstractDiscount = new AbstractDiscount();
        $abstractDiscount->setFigure(12.50);
        $this->assertEquals($abstractDiscount->calculate(), 12.50);
        unset($abstractDiscount);
    }

    /**
     * Test the setFigure and getFigure function.
     */
    public function testSetGetFigure()
    {  
        $abstractDiscount = new AbstractDiscount();
        $abstractDiscount->setFigure(12.50);
        $this->assertEquals($abstractDiscount->getFigure(), 12.50);
        unset($abstractDiscount);
    }

    /**
     * Test the setDescription and getDescription function.
     */
    public function testSetGetDescription()
    {  
        $abstractDiscount = new AbstractDiscount();
        $abstractDiscount->setDescription('10% standard discount');
        $this->assertEquals($abstractDiscount->getDescription(), '10% standard discount');
        unset($abstractDiscount);
    }
}