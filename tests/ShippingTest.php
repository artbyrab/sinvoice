<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\Entity;
use \DateTime;

/**
 * Sinvoice Invoice Model Test
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
    public function testConstructWithParams()
    {
        $date = new DateTime('+14 days');

        $shipping = new Shipping(
            array(
                'recipient' => new Entity(
                    array(
                        'name' => 'Ceasar',
                        'address' => '1 High Street, Rome, Italy',
                        'phone' => '01245 678910',
                        'email' => 'ceasar@rome.com',
                        'reference' => 'a145',
                    )
                ),
                'price' => 10.99,
                'deliveryDate' => $date->format('Y-m-d'),
                'handler' => 'Rome Road Mail',
                'reference' => '8547124',
            )
        );

        $date = new DateTime('+14 days');

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
        $shipping = new Shipping();
        $shipping->addRecipient(
            new Entity(
                array(
                    'name' => 'Ceasar',
                    'address' => '1 High Street, Rome, Italy',
                    'phone' => '01245 678910',
                    'email' => 'ceasar@rome.com',
                    'reference' => 'a145',
                )
            )
        );
        $this->assertEquals($shipping->recipient->getName(), 'Ceasar');
        $this->assertEquals($shipping->recipient->getAddress(), '1 High Street, Rome, Italy');
        $this->assertEquals($shipping->recipient->getPhone(), '01245 678910');
        $this->assertEquals($shipping->recipient->getEmail(), 'ceasar@rome.com');
        $this->assertEquals($shipping->recipient->getReference(), 'a145');
        unset($shipping);
    }

    /**
     * Test the Set and Get price functions
     */
    public function testSetGetPrice()
    {
        $shipping = new Shipping();
        $shipping->setPrice(7.99);
        $this->assertEquals($shipping->getPrice(), 7.99);
        unset($shipping);
    }

    /**
     * Test the Set and Get delivery date functions
     */
    public function testSetGetDeliveryDate()
    {
        $shipping = new Shipping();

        $date = new DateTime('+14 days');

        $shipping->setDeliveryDate('+14 days');
        $this->assertEquals($shipping->getDeliveryDate(), $date->format('Y-m-d'));
        unset($shipping);
    }

    /**
     * Test the Set and Get handler functions
     */
    public function testSetGetHandler()
    {
        $shipping = new Shipping();
        $shipping->setHandler('Rome Horse Mail');
        $this->assertEquals($shipping->getHandler(), 'Rome Horse Mail');
        unset($shipping);
    }

    /**
     * Test the Set and Get reference functions
     */
    public function testSetGetReference()
    {
        $shipping = new Shipping();
        $shipping->setReference('4578541878');
        $this->assertEquals($shipping->getReference(), '4578541878');
        unset($shipping);
    }
}
