# Full Examples
Below are some full examples of building an invoice.

## Example One
```
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;
use Rabus\Sinvoice\Shipping;
use Rabus\Sinvoice\Entity;

$invoice = (new Invoice())
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
    )
    ->addItem(
        new Item())
        ->setName('Gladius Sword')
        ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
        ->setPrice(120.00)
        ->setQuantity(1);
    )
```
