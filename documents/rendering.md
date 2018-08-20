# Rendering

Rendering your invoices with Sinvoice is relatively easy. There are methods that make displaying easy whatever you are using to visualise it.

## Invoice rendering methods
### Self explanatory invoice methods
```
$invoice->getNumber();
$invoice->getReference();
$invoice->getCreatedDate();
$invoice->getIssuedDate();
$invoice->getDueDate();
```

### Invoice Entity methods
When getting entities like the supplier, customer or recipient for shipping you can use the attributes of the entity model, or you can use the quicker shorter methods of the invoice model.

Below are the invoice shorter methods:
```
$invoice->getSupplier();

# will return the following:
'Rome Suppliers, 1 Main Street, Industrial District, Rome, Italy, 01234 567899, rsuppliers@rome.com, rsa'

$invoice->getCustomer();

# Will return:
'Emperor Nero, Via Cavour, Rome, Italy, 01234 567891, nero@rome.com, nero123'

$invoice->shipping->getRecipient();

# Where the customer is the same as the recipient it will return:
'Emperor Nero, Via Cavour, Rome, Italy, 01234 567891, nero@rome.com, nero123'
```

Of course you can build the entity in your template up using the following entity methods if you require more control. For a supplier you would do the following:
```
$invoice->supplier->getName();
$invoice->supplier->getAddress();
$invoice->supplier->getEmail();
$invoice->supplier->getPhone();
$invoice->supplier->getReference();
```

For the customer you would do:
```
$invoice->customer->getName();
...
```

And to get the shipping recipient you would do:
```
$invoice->shipping->recipient->getName();
...
```

### Invoice items
To display your invoice items you will need to iterate over them first:
```
foreach ($invoice->getItems() as $item) {
    echo $item->getPrice();
}
```

When you are iterating you can use the following methods:
```
$item->getName();
$item->getDescription();
$item->getPrice();
$item->getQuantity();
$item->getDiscount();
$item->getPriceTotal();
$item->getNetTotal();
```

Whilst you are iterating you might want to know if any of your items have a discount. If they don't then you wont need to show a discount column.

```
# will return True or False
$invoice->hasItemDiscount();
```

### Invoice totals
The invoice totals let you disply the final invoice calculations.
```
$invoice->totals->getItemNetTotal();
$invoice->totals->getdiscount();
$invoice->totals->getitemDiscountTotal();
$invoice->totals->discountTotal();
$invoice->totals->shippingHandlingTotal();
$invoice->totals->otherChargesTotal();
$invoice->totals->netTotal();
$invoice->totals->taxTotal();
$invoice->totals->grossTotal();
```

When you are displaying the invoice totals you might only need a few of the above as detailed below:
```
# this is the invoice only discount
$invoice->totals->getdiscount();

# net total is before tax
$invoice->totals->netTotal();

# tax total is the amount of tax the customer is paying
$invoice->totals->taxTotal();

# gross/billable total
$invoice->totals->grossTotal();
```

The item discount total and discount total are just easy metrics you might want to store in your database to understand the total item discounts you are giving.

