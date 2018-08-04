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
        $abstractDiscount = new AbstractDiscount();
        $this->assertTrue(is_object($abstractDiscount));
        unset($abstractDiscount);
    }
}