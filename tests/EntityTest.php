<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Entity;

/**
 * Sinvoice Entity Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter EntityTest tests/EntityTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct EntityTest tests/EntityTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class EntityTest extends TestCase
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
        $entity = new Entity();
        $this->assertTrue(is_object($entity));
        unset($entity);
    }

    /**
     * Test the construct function
     */
    public function testConstructWithParams()
    {
        $entity = new Entity(
            array(
                'name' => 'Emperor Nero',
                'address' => 'Via Cavour, Rome, Italy',
                'phone' => '01234 567891',
                'email' => 'nero@rome.com',
                'reference' => 'nero123',
            )
        );

        $this->assertTrue(is_object($entity));
        $this->assertEquals($entity->getName(), 'Emperor Nero');
        $this->assertEquals($entity->getAddress(), 'Via Cavour, Rome, Italy');
        $this->assertEquals($entity->getPhone(), '01234 567891');
        $this->assertEquals($entity->getEmail(), 'nero@rome.com');
        $this->assertEquals($entity->getReference(), 'nero123');
        unset($entity);
    }

    /**
     * Test the ... function
     */
    public function testConstructWithFluidInterface()
    {
        $date = new DateTime('+14 days');

        $entity = (new Entity())
            ->setName('Emperor Nero')
            ->setAddress('Via Cavour, Rome, Italy')
            ->setPhone('01234 567891')
            ->setEmail('nero@rome.com')
            ->setReference('nero123');

        $this->assertTrue(is_object($entity));
        $this->assertEquals($entity->getName(), 'Emperor Nero');
        $this->assertEquals($entity->getAddress(), 'Via Cavour, Rome, Italy');
        $this->assertEquals($entity->getPhone(), '01234 567891');
        $this->assertEquals($entity->getEmail(), 'nero@rome.com');
        $this->assertEquals($entity->getReference(), 'nero123');
        unset($entity);
    }

    /**
     * Test the formatToString function
     */
    public function testformatToString()
    {
        $entity = (new Entity())
            ->setName('Emperor Nero')
            ->setAddress('Via Cavour, Rome, Italy')
            ->setPhone('01234 567891')
            ->setEmail('nero@rome.com')
            ->setReference('nero123');

        $this->assertEquals($entity->formatToString(), 'Emperor Nero, Via Cavour, Rome, Italy, 01234 567891, nero@rome.com, nero123');
        unset($entity);
    }

    /**
     * Test the formatToString function
     */
    public function testformatToStringWithSeperator()
    {
        $entity = (new Entity())
            ->setName('Emperor Nero')
            ->setAddress('Via Cavour, Rome, Italy')
            ->setPhone('01234 567891')
            ->setEmail('nero@rome.com')
            ->setReference('nero123');

        $this->assertEquals($entity->formatToString('*'), 'Emperor Nero*Via Cavour, Rome, Italy*01234 567891*nero@rome.com*nero123');
        unset($entity);
    }


    /**
     * Test the Set and Get name functions
     */
    public function testSetGetName()
    {
        $entity = new Entity();
        $entity->setName('Commodus');
        $this->assertEquals($entity->getName(), 'Commodus');
        unset($entity);
    }

    /**
     * Test the Set and Get address functions
     */
    public function testSetGetAddress()
    {
        $entity = new Entity();
        $entity->setAddress('Via della Conciliazione');
        $this->assertEquals($entity->getAddress(), 'Via della Conciliazione');
        unset($entity);
    }

    /**
     * Test the Set and Get phone functions
     */
    public function testSetGetPhone()
    {
        $entity = new Entity();
        $entity->setPhone('04789 247541');
        $this->assertEquals($entity->getPhone(), '04789 247541');
        unset($entity);
    }

    /**
     * Test the Set and Get email functions
     */
    public function testSetGetEmail()
    {
        $entity = new Entity();
        $entity->setEmail('commodus@rome.com');
        $this->assertEquals($entity->getEmail(), 'commodus@rome.com');
        unset($entity);
    }

    /**
     * Test the Set and Get Reference function
     */
    public function testSetGetReference()
    {
        $entity = new Entity();
        $entity->setReference('commodus123');
        $this->assertEquals($entity->getReference(), 'commodus123');
        unset($entity);
    }
}
