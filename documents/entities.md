# Entities

Entities relate to a person/group/company, in the case of Sinvoice it refers to customers, suppliers and recipients. So whenever you create any of the following, you would utilise the Entity model as the base.

## Adding a supplier to an invoice
```
$invoice = new Invoice();

$invoice->addSupplier(
    (new Entity())
        ->setName('Emperor Nero')
        ->setAddress('Via Cavour, Rome, Italy')
        ->setPhone('01234 567891')
        ->setEmail('nero@rome.com')
        ->setReference('nero123')
);
```

## Adding a customer
Essentially adding a customer is essentially the same except this time we use the addCustomer function.
```
$invoice = new Invoice();

$invoice->addCustomer(
    (new Entity())
        ->setName('Emperor Nero')
        ->setAddress('Via Cavour, Rome, Italy')
        ->setPhone('01234 567891')
        ->setEmail('nero@rome.com')
        ->setReference('nero123')
);
```

## Removing a customer/supplier
To remove a customer/supplier is just as simple, presuming you already have a suplier
```
$invoice->removeSupplier();
```

```
$invoice->removeCustomer();
```

## Adding/removing a recipient
Adding a recipient is slightly different as you would set it when adding the shipping. For this you should refer to the shipping guide.