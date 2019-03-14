<?php 

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\FlatDiscount;

/**
 * Sinvoice FlatDiscount Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter FlatDiscountTest tests/FlatDiscountTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct FlatDiscountTest tests/FlatDiscountTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class FlatDiscountTest extends TestCase
{

    /**
     * Test the construct function
     */
    public function testConstruct()
    {
        $flatDiscount = new FlatDiscount();
        $this->assertTrue(is_object($flatDiscount));
        unset($flatDiscount);
    }

    /**
     * Test the calculate function.
     */
    public function testCalculate()
    {  
        $flatDiscount = new FlatDiscount();
        $flatDiscount->setFigure(5);
        $this->assertEquals($flatDiscount->calculate(), 5);
        unset($flatDiscount);
    }

    /**
     * Test the setFigure and getFigure function.
     */
    public function testSetGetFigure()
    {  
        $flatDiscount = new FlatDiscount();
        $flatDiscount->setFigure(5);
        $this->assertEquals($flatDiscount->getFigure(), 5);
        unset($flatDiscount);
    }

    /**
     * Test the setDescription and getDescription function.
     */
    public function testSetGetDescription()
    {  
        $flatDiscount = new FlatDiscount();
        $flatDiscount->setDescription('5 flat discount');
        $this->assertEquals($flatDiscount->getDescription(), '5 flat discount');
        unset($flatDiscount);
    }

}