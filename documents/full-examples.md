# Full Examples
Below are some full examples of building an invoice.

## Example One
```
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Item;
use artbyrab\sinvoice\Shipping;
use artbyrab\sinvoice\Entity;

$invoice = (new Invoice())
    ->setNumber(1)
    ->setIssuedDate('Today')
    ->setDueDate('+21 Days)
    ->addTaxPercentage(20.00)
    ->addSupplier(
        (new Entity())
        ->setName('Rome Gifts and Hardware')
        ->setAddress('230 High Street, Rome, Italy')
        ->setPhone('01245 678918')
        ->setEmail('romegifts@rome.com')
        ->setReference('rg1')
    )
    ->addCustomer(
        (new Entity())
        ->setName('Ceasar')
        ->setAddress('1 High Street, Rome, Italy')
        ->setPhone('01245 678910')
        ->setEmail('ceasar@rome.com')
        ->setReference('a145')
    )
    ->addShipping(
        (new Shipping())
        ->addRecipient(
            (new Entity())
            ->setName('Mrs Ceaser')
            ->setAddress('1 High Street, Rome, Italy')
            ->setPhone('01245 678910')
            ->setEmail('mrsceasar@rome.com')
            ->setReference('a146')
        )
        ->setPrice(10.99)
        ->setDeliveryDate('+7 days')
        ->setHandler('Rome Road Mail')
        ->setReference('8547124');
    )
    ->addItem(
        new Item())
        ->setName('Gladius Sword')
        ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
        ->setPrice(120.00)
        ->setQuantity(1);
        ->addDiscount(
            (new PercentageDiscount())
            ->setFigure(10)
        )
    )
    ->addItem(
        new Item())
        ->setName('Gladius Sword')
        ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
        ->setPrice(120.00)
        ->setQuantity(1);
        ->addDiscount(
            (new FlatDiscount())
            ->setFigure(50)
        )
    )
    ->addDiscount(
            (new FlatDiscount())
            ->setFigure(10)
        )
```
