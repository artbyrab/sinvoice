# Items

Items are the products/services that your customer is getting billed for on your invoice. Items are added to your invoice and then the totals are automatically recalculated afterwards. The totals are also recalculated when items are 
removed or the item basket is cleared.

## Adding an item to an invoice 
```
use Rabus\Sinvoice\Invoice;
use Rabus\Sinvoice\Item;

$invoice = new Invoice();

$item = (new Item())
    ->setName('Gladius Sword')
    ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
    ->setPrice(120.00)
    ->setQuantity(4);

$invoice->addItem($item);

```

Your invoice will now show the items and have calculated your totals as below:
```
print_r($invoice->getTotals());

Rabus\Sinvoice\Totals Object
(
    [itemNetTotal:Rabus\Sinvoice\Totals:private] => 480
    [discount:Rabus\Sinvoice\Totals:private] => 0
    [itemDiscountTotal:Rabus\Sinvoice\Totals:private] => 0
    [discountTotal:Rabus\Sinvoice\Totals:private] => 0
    [shippingHandlingTotal:Rabus\Sinvoice\Totals:private] => 0
    [otherChargesTotal:Rabus\Sinvoice\Totals:private] => 0
    [netTotal:Rabus\Sinvoice\Totals:private] => 480
    [taxTotal:Rabus\Sinvoice\Totals:private] => 0
    [grossTotal:Rabus\Sinvoice\Totals:private] => 480
)

```

## You can also add the items during the item creation using the fluid interface
```
$sinvoice = (new Invoice())
    ->setNumber(1)
    ->setIssuedDate('Today')
    ->setDueDate('+21 Days)
    ->addTaxPercentage(20.00)
    ->addItem(
        (new Item())
        ->setName('Gladius Sword')
            ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
            ->setPrice(120.00)
            ->setQuantity(2);
        ->addDiscount(
            (new PercentageDiscount())
            ->setFigure(10)
        )
    );
```

## Removing an item
When removing an item you need to pass it the array key.
```
$invoice->removeItem(1);
```

## Clearing the items
Clearing the items will delete all the items.
```
$invoice->clearItems();
```

## Getting the items
For display purposes you will need to iterate over the items which you can do after getting them.
```
foreach ($invoice->getItems() as $item) {
    echo $item->name;

}
```

The only point i have not covered here is adding a discount to your item. I will cover that in the discount guide.
