<?php

use PHPUnit\Framework\TestCase;
use artbyrab\sinvoice\Shipping;
use artbyrab\sinvoice\Entity;

/**
 * Sinvoice Shipping Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter ShippingTest tests/ShippingTest.php
 *
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct ShippingTest tests/ShippingTest.php
 *
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class ShippingTest extends TestCase
{
    public $shipping;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->shipping = new Shipping();
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {
        unset($this->shipping);
    }

    /**
     * Test the ... function
     */
    public function testConstruct()
    {
        $shipping = new Shipping();
        $this->assertTrue(is_object($shipping));
        unset($shipping);
    }

    /**
     * Test the ... function
     */
    public function testConstructWithFluidInterface()
    {
        $shipping = (new Shipping())
            ->addRecipient(
                (new Entity())
                    ->setName('Ceasar')
                    ->setAddress('1 High Street, Rome, Italy')
                    ->setPhone('01245 678910')
                    ->setEmail('ceasar@rome.com')
                    ->setReference('a145')
            )
            ->setPrice(10.99)
            ->setDeliveryDate('+7 days')
            ->setHandler('Rome Road Mail')
            ->setReference('8547124');

        $date = new DateTime('+7 days');

        $this->assertTrue(is_object($shipping));
        $this->assertEquals($shipping->recipient->getName(), 'Ceasar');
        $this->assertEquals($shipping->recipient->getAddress(), '1 High Street, Rome, Italy');
        $this->assertEquals($shipping->recipient->getPhone(), '01245 678910');
        $this->assertEquals($shipping->recipient->getEmail(), 'ceasar@rome.com');
        $this->assertEquals($shipping->recipient->getReference(), 'a145');
        $this->assertEquals($shipping->getPrice(), 10.99);
        $this->assertEquals($shipping->getDeliveryDate(), $date->format('Y-m-d'));
        $this->assertEquals($shipping->getHandler(), 'Rome Road Mail');
        $this->assertEquals($shipping->getReference(), '8547124');
        unset($shipping);
    }

    /**
     * Test the Add and Get recipient functions
     */
    public function testAddGetRecipient()
    {
        $this->shipping->addRecipient(
            (new Entity())
            ->setName('Ceasar')
            ->setAddress('1 High Street, Rome, Italy')
            ->setPhone('01245 678910')
            ->setEmail('ceasar@rome.com')
            ->setReference('a145')
        );
        $this->assertEquals($this->shipping->recipient->getName(), 'Ceasar');
        $this->assertEquals($this->shipping->recipient->getAddress(), '1 High Street, Rome, Italy');
        $this->assertEquals($this->shipping->recipient->getPhone(), '01245 678910');
        $this->assertEquals($this->shipping->recipient->getEmail(), 'ceasar@rome.com');
        $this->assertEquals($this->shipping->recipient->getReference(), 'a145');
    }

    /**
     * Test the Set and Get price functions
     */
    public function testSetGetPrice()
    {
        $this->shipping->setPrice(7.99);
        $this->assertEquals($this->shipping->getPrice(), 7.99);
    }

    /**
     * Test the Set and Get delivery date functions
     */
    public function testSetGetDeliveryDate()
    {
        $date = new DateTime('+14 days');
        $this->shipping->setDeliveryDate('+14 days');
        $this->assertEquals($this->shipping->getDeliveryDate(), $date->format('Y-m-d'));
    }

    /**
     * Test the Set and Get handler functions
     */
    public function testSetGetHandler()
    {
        $this->shipping->setHandler('Rome Horse Mail');
        $this->assertEquals($this->shipping->getHandler(), 'Rome Horse Mail');
    }

    /**
     * Test the Set and Get reference functions
     */
    public function testSetGetReference()
    {
        $this->shipping->setReference('4578541878');
        $this->assertEquals($this->shipping->getReference(), '4578541878');
    }
}
