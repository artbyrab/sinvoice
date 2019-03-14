<?php 

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\Charge;

/**
 * Sinvoice Charge Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter ChargeTest tests/ChargeTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct ChargeTest tests/ChargeTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class ChargeTest extends TestCase
{
    /**
     * Test the construct function
     */
    public function testConstruct()
    {
        $charge = new Charge();
        $this->assertTrue(is_object($charge));
        unset($charge);
    }

    /**
     * Test the construct function with the fluid interface
     */
    public function testConstructWithFluidInterface()
    {
        $charge = (new Charge())
            ->setPrice(17.99)
            ->setDescription('Centurion Guarded Delivery');

        $this->assertTrue(is_object($charge));
        $this->assertEquals($charge->getPrice(), 17.99);
        $this->assertEquals($charge->getDescription(), 'Centurion Guarded Delivery');
        unset($charge);
    }

    /**
     * Test the Set and Get price functions
     */
    public function testSetGetPrice()
    {
        $charge = new Charge();
        $charge->setPrice(18.99);
        $this->assertEquals($charge->getPrice(), 18.99);
        unset($charge);
    }

    /**
     * Test the Set and Get description functions
     */
    public function testSetGetDescription()
    {
        $charge = new Charge();
        $charge->setDescription('Centurion Guarded Delivery via Horse');
        $this->assertEquals($charge->getDescription(), 'Centurion Guarded Delivery via Horse');
        unset($charge);
    }
}