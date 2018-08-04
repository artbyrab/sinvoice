<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\FiatDiscount;

/**
 * Sinvoice FiatDiscount Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter FiatDiscountTest tests/FiatDiscountTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct FiatDiscountTest tests/FiatDiscountTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class FiatDiscountTest extends TestCase
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
        $fiatDiscount = new FiatDiscount();
        $this->assertTrue(is_object($fiatDiscount));
        unset($fiatDiscount);
    }