# Invoice Factory 

When creating invoices in your system you will more than likely want to remove some of the constant information. For example, supplier details(you), tax percentage and issued and due dates are all information that you will likely configure once. The solution to using constants or global variables is to implment a simple invoice factory. 

The invoice factory will be responsible for generating your invoices.

## Using the default invoice factory

To set up your invoice factory do the following:

```
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\InvoiceFactory;

$invoiceFactory = (new InvoiceFactory())
    ->addSupplier(
        (new Entity())
        ->setName('Emperor Nero')
        ->setAddress('Via Cavour, Rome, Italy')
        ->setPhone('01234 567891')
        ->setEmail('nero@rome.com')
        ->setReference('nero123')
    )
    ->setTaxPercentage(20)
    ->setIssuedDate('Today')
    ->setDueDate('+21 days');
```

Now, to build an invoice you simply do the following:
```
$invoice = $invoiceFactory->buildInvoice();

```

Now you can add your non standard attributes to your invoice as normal. 
```
$invoice->setNumber(1)
    ->setReference()
    ->addCustomer(
        (new Entity())
        ->setName('Ceaser')
    ...
    )
```

