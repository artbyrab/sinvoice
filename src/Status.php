<?php 

/**
 * Sinvoice an invoicing model.
 * 
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in 
 * this paackage.
 */

namespace Rabus\Sinvoice;

/**
 * Status
 * 
 * The status model will handle where the invoice is in its lifecycle. The 
 * lifecylce stages are as follows:
 *  - Draft
 *      - The invoice is either being created or has been created and is waiting
 *      to be submitted.
 *  - Submitted
 *      - The invoice has been submitted to be approved.
 *  - Authorised
 *      - The invoice has been approved and is awaiting payment where a payment 
 *      may be a full or partial amount outstanding.
 *  - Paid
 *      - The invoice has been paid in full.
 *  - Void 
 *      - The invoice has been voided meaning it has been cancelled but a 
 *      record needs to be kept.
 *  - Deleted
 *      - The invoice is marked as deleted typically because the invoice was 
 *      issued in error and no record needs to be kept.
 * 
 * There are limitations on changing a status to another, for example you cannot
 * mark an invoice that has been authorised to a draft. Additionally you cannot
 * set a status to deleted for an invoice that has already been paid.
 * 
 * As the status of an invoice can be quite complex and could litter the 
 * invoice model we will seperate out the logic here.
 *  
 * @author RABUS
 */
class Status {

    /**
     * @var string $status Defines where the invoice is in its lifecycle. 
     */
    private $status = self::STATUS_DRAFT;

    /**
     * @var integer STATUS_DRAFT The invoice is either being created or has been 
     * created and is waiting to be submitted
     */
    const STATUS_DRAFT = 1;

    /**
     * @var integer STATUS_SUBMITTED The ivnoice has been submitted to be
     * approved.
     */
    const STATUS_SUBMITTED = 2;

    /**
     * @var integer STATUS_AUTHORISED The invoice has been approved and is 
     * awaiting payment where a payment may be a full or partial amount 
     * outstanding.
     */
    const STATUS_AUTHORISED = 3;

    /**
     * @var integer STATUS_PAID The invoice has been paid in full.
     */
    const STATUS_PAID = 4;

    /**
     * @var integer STATUS_VOID The invoice has been voided meaning it has been
     * cancelled but a record needs to be kept.
     */
    const STATUS_VOID = 5;

    /**
     * @var integer STATUS_DELETED The invoice is marked as deleted typically 
     * because the invoice was issued in error and no record needs to be kept
     */
    const STATUS_DELETED = 6;

    /**
     * Get the status
     * 
     * @return integer The status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set to draft.
     * 
     * @return True 
     * @throws Exception If the status is higher than 'Submitted'.
     */
    public function setDraft()
    {
        if (in_array($this->status, array(self::STATUS_DRAFT, self::STATUS_SUBMITTED))) {
            $this->status = self::STATUS_DRAFT;
            return True;
        }
        throw new \Exception("You can only set an invoice to 'Draft' if it has a status of 'Draft' or 'Submitted'.");
    }

    /**
     * Set to submitted.
     * 
     * @throws Exception If the status is higher than 'Authorised'.
     */
    public function setSubmitted()
    {
        if (in_array($this->status, array(self::STATUS_DRAFT, self::STATUS_SUBMITTED))) {
            $this->status = self::STATUS_SUBMITTED;
            return True;
        }
        throw new \Exception("You can only set an invoice to 'Submitted' if it has a status of 'Draft' or 'Submitted'.");
    }

    /**
     * Set to authorised.
     * 
     * @throws Exception If the status is higher than 'Paid'.
     */
    public function setAuthorised()
    {
        if (in_array($this->status, array(self::STATUS_DRAFT, self::STATUS_SUBMITTED, self::STATUS_AUTHORISED))) {
            $this->status = self::STATUS_AUTHORISED;
            return True;
        }
        throw new \Exception("You can only set an invoice to 'Authorised' if it has a status of 'Draft', 'Submitted' or 'Authorised'.");
    }

    /**
     * Set to paid.
     * 
     * @throws Exception If the status is higher than 'Paid'.
     */
    public function setPaid()
    {
        if (in_array($this->status, array(self::STATUS_AUTHORISED))) {
            $this->status = self::STATUS_PAID;
            return True;
        }
        throw new \Exception("You can only set an invoice to 'Paid' if it has a status of 'Authorised'.");
    }

    /**
     * Set to void.
     * 
     * @throws Exception If the status is equal 'Paid'.
     */
    public function setVoid()
    {
        if (in_array($this->status, array(self::STATUS_AUTHORISED))) {
            $this->status = self::STATUS_VOID;
            return True;
        }
        throw new \Exception("You can only set an invoice to 'Void' if it has a status of 'Authorised'.");
    }

    /**
     * Set to deleted.
     * 
     * @throws Exception If the status is equal to 'Paid'.
     */
    public function setDeleted()
    {
        // if ($this->status == self::STATUS_PAID) {
        //     throw new \Exception("You cannot set an invoice to 'Deleted' if it is marked as 'Paid'.");
        // }
        $this->status = self::STATUS_DELETED;
    }
}