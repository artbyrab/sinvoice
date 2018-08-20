# Sinvoice for PHP - An invoicing library

![Image](files/graphics/sinvoice-logo.png?raw=true)

Sinvoice is a PHP invoicing library that allows you to easily and quickly create invoices. It is a sin not to use Sinvoice.

Sinvoice Terminology:
* Sinvoice
    * The best kind of invoice
* Invoice
    * The invoice
* Entities
    * A person/group/company, in the case of Sinvoice it refers to customers, suppliers and recipients
* Supplier
    * The entity issuing the invoice
* Customer
    * The entity receiving the invoice
* Recipient
    * The entity receiving a delivery
* Shipping
    * The details pertaining to a delivery
* Items
    * Items are what is being sold to the customer
    * They are added per item * quantity
* Discounts
    * Discounts are percentage or flat based and can be applied to items and invoices
* Charges
    * Charges are a way to add costs to invoices that are not items
* Totals
    * Totals are the invoice totals
* Invoice Factory
    * A method to build invoices with various attributes built in, like supplier and tax percentages
    
###  Features

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Comprehensive Guides and tutorial
* Easy to use to any framework or even a plain php file

## Requirements
PHP 7.0

However i have not tested it with PHP 5+ so it may be compatible.

## Installation
Install via composer command line:

```
composer require rabus\sinvoice:dev-master
```

Install via adding to your composer.json file:
```
"rabus/": "0.1*"
```

## Usage

Creating a new invoice using the fluid interface

```
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Entity;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\item;

$sinvoice = (new Invoice())
    ->setNumber(1)
    ->setIssuedDate('Today')
    ->setDueDate('+21 Days)
    ->addTaxPercentage(20.00)
    ->addSupplier(
        (new Entity())
            ->setName('Quality Roman Suppliers')
            ->setAddress('1 Ampitheatre Road, Rome')
    )
    ->addCustomer(
        (new Entity())
            ->setName('Julius Ceaser')
            ->setAddress('Todo')
    )
    ->addShipping(php implement observer what is the obserer object updates
        (new Shipping())
    )
    ->addItem(
        (new Item())
            ->setName('')
            ->setPrice(4.99)
            ->setQuantity(5)
    )
```

Learn more about the other parts of Sinvoice:
* [Items guide](documents/items.md)
* [Entities(suppliers/customers) guide](documents/entities.md)
* [Discounts guide](documents/discounts.md)
* [Totals guide](documents/totals.md)
* [Full Examples](documents/full-examples.md)
* [Rendering guide](documents/rendering.md)
* [Rendering Examples guide](documents/rendering-examples.md)
* [Invoice Factory guide](documents/invoice-factory.md)
* [Fluid Interface guide](documents/fluid-interface.md) 


