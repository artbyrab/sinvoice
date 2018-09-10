<?php 

use PHPUnit\Framework\TestCase;
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Status;


/**
 * Sinvoice Status Model Test
 *
 * To run this test class only:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter StatusTest tests/StatusTest.php
 * 
 * To run a single test class in this model:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: vendor/bin/phpunit --filter testConstruct StatusTest tests/StatusTest.php
 * 
 * To run all tests:
 *  - Navigate to: ~Rabus/Sinvoice/
 *  - Type: $ vendor/bin/phpunit
 *
 * @author Rabus
 */
class StatusTest extends TestCase
{
    private $invoice;
    private $status;

    /**
     * Set up
     *
     * Performed before every test.
     */
    protected function setUp()
    {
        $this->invoice = New Invoice();
        $this->status = New Status();
    }

    /**
     * Tear down
     *s
     * Performed after every test.
     */
    protected function tearDown()
    {  
        unset($this->invoice);
        unset($this->status);
    }

    /**
     * Test the setDraft function
     */
    public function testSetDraft()
    {
        $this->status->setDraft();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_DRAFT);  
    }

    /**
     * Test the setDraft function errors when you set it from an authorised.
     */
    public function testSetDraftFromAuthorisedErrors()
    {
        $this->status->setAuthorised();

        // lets catch the error and assert it matches
        try {
            $this->status->setDraft();
        } catch (\Exception $e) { 
            $this->assertEquals("You can only set an invoice to 'Draft' if it has a status of 'Draft' or 'Submitted'.", $e->getMessage());
        }
    }

    /**
     * Test the setSubmitted function
     */
    public function testSetSubmitted()
    {
        $this->status->setSubmitted();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_SUBMITTED);  
    }

    /**
     * Test the setDraft function errors when you set it from submitted.
     */
    public function testSetSubmittedFromPaidErrors()
    {
        $this->status->setAuthorised();
        $this->status->setPaid();

        // lets catch the error and assert it matches
        try {
            $this->status->setSubmitted();
        } catch (\Exception $e) { 
            $this->assertEquals("You can only set an invoice to 'Submitted' if it has a status of 'Draft' or 'Submitted'.", $e->getMessage());
        }
    }

    /**
     * Test the setAuthorised function
     */
    public function testSetAuthorised()
    {
        $this->status->setAuthorised();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_AUTHORISED);  
    }

    /**
     * Test the setDraft function errors when you set it from paid.
     */
    public function testSetAuthorisedFromPaidErrors()
    {
        $this->status->setAuthorised();
        $this->status->setPaid();

        // lets catch the error and assert it matches
        try {
            $this->status->setAuthorised();
        } catch (\Exception $e) { 
            $this->assertEquals("You can only set an invoice to 'Authorised' if it has a status of 'Draft', 'Submitted' or 'Authorised'.", $e->getMessage());
        }
    }

    /**
     * Test the setPaid function
     * 
     * Please note as you cannot set any status to paid, we need to set the 
     * status to invoice before.
     */
    public function testSetPaid()
    {
        $this->status->setAuthorised();

        $this->status->setPaid();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_PAID);  
    }

    /**
     * Test the setDraft function errors when you set it from draft.
     */
    public function testSetPaidFromDraftErrors()
    {
        $this->status->setDraft();

        // lets catch the error and assert it matches
        try {
            $this->status->setPaid();
        } catch (\Exception $e) { 
            $this->assertEquals("You can only set an invoice to 'Paid' if it has a status of 'Authorised'.", $e->getMessage());
        }
    }

    /**
     * Test the setVoid function
     * 
     * Please note as you cannot set any status to paid, we need to set the 
     * status to invoice before.
     */
    public function testSetVoid()
    {
        $this->status->setAuthorised();

        $this->status->setVoid();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_VOID);  
    }

    /**
     * Test the setDraft function errors when you set it from draft
     */
    public function testSetVoidFromDraftErrors()
    {
        $this->status->setDraft();

        // lets catch the error and assert it matches
        try {
            $this->status->setVoid();
        } catch (\Exception $e) { 
            $this->assertEquals("You can only set an invoice to 'Void' if it has a status of 'Authorised'.", $e->getMessage());
        }
    }

    /**
     * Test the setDeleted function
     */
    public function testSetDeleted()
    {
        $this->status->setDeleted();
        $this->assertEquals($this->status->getStatus(), Status::STATUS_DELETED);  
    }

}