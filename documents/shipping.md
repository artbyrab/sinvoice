# Shipping

If the items on your invoice need to be shipping to a recipient then you need to use the shipping on your invoice. Shipping is a seperate model that makes it easy to add if you need it or ignore if you dont.

## Recipients
As the shipping of your items can be sent to anyone we will use the terminology of a recipient as the entity that is going to receive the items. This might be your customer or someone new.

## Totals
When you add shipping to an invoice it automatically recalculates the invoice totals after to reflect the changes.

## Creating and adding shipping to an invoice
```
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Shipping;
use artbyrab\sinvoice\Entity;

$invoice = new Invoice();

$shipping = 
    (new Shipping())
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

$invoice->addShipping($shipping);
```

## Adding as part of the invoice fluid interface
Of course you can add the shipping as part of the invoice creation
```
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Shipping;
use artbyrab\sinvoice\Entity;

$invoice = (new Invoice())
    ->addShipping(
        (new Shipping())
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
        ->setReference('8547124')
    );
```