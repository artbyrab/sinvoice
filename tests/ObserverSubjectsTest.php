<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\ObserverSubjects;
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\DummyObserver;

/**
 * Sinvoice ObserverSubjects Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter ObserverSubjectsTest tests/ObserverSubjectsTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct ObserverSubjectsTest tests/ObserverSubjectsTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 * 
 * Please note, this test uses a dummy observer object to make testing the 
 * notify and subsequent observer update functions.
 *
 * @author Rabus
 */
class ObserverSubjectsTest extends TestCase
{
    public $invoice;
    public $dummyObserver;
    public $obseverSubjects;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->invoice = new Invoice();
        $this->dummyObserver = new DummyObserver();
        $this->observerSubjects = new ObserverSubjects();
    }

    /**
     * Tear down
     *
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->invoice);
        unset($this->dummyObserver);
        unset($this->observerSubjects);
    }

    /**
     * Test the attach function
     */
    public function testAttach()
    {
        $this->observerSubjects->attach($this->invoice);
        $observerKey = spl_object_hash($this->invoice);
        $this->assertInstanceOf(Invoice::class, $this->observerSubjects->observers[$observerKey]);
    }

    /**
     * Test the detach function
     */
    public function testDetach()
    {
        $this->observerSubjects->attach($this->invoice);
        $this->observerSubjects->detach($this->invoice);
        $this->assertEmpty($this->observerSubjects->observers);
    }

    /**
     * Test the notify function
     * 
     * This makes use of the dummy observer object that makes testing easier.
     */
    public function testNotify()
    {
        $this->observerSubjects->attach($this->dummyObserver);
        $this->observerSubjects->notify();
        $this->assertEquals($this->dummyObserver->status, DummyObserver::STATUS_ACTIVE);
    }
}