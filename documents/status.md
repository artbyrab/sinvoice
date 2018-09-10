# Status

Each invoice created with Sinvoice starts life with a status of 'Draft'. You can change the status at any time from the status attribute model.

## Status types
The below are the status types:
- Draft
    - The invoice is either being created or has been created and is waiting
    to be submitted.
- Submitted
    - The invoice has been submitted to be approved.
- Authorised
    - The invoice has been approved and is awaiting payment where a payment 
    may be a full or partial amount outstanding.
- Paid
    - The invoice has been paid in full.
- Void 
    - The invoice has been voided meaning it has been cancelled but a 
    record needs to be kept.
- Deleted
    - The invoice is marked as deleted typically because the invoice was 
    issued in error and no record needs to be kept.

## Change the status
```
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Status;


$invoice = new Invoice()
    ->status->setStatusApproved();
```

## Get the current status
```
$invoice->status->getStatus();
```


