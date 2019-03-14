# Items

Items are the products/services that your customer is getting billed for on your invoice. Items are added to your invoice and then the totals are automatically recalculated afterwards. The totals are also recalculated when items are 
removed or the item basket is cleared.

## Adding an item to an invoice 
```
use artbyrab\sinvoice\Invoice;
use artbyrab\sinvoice\Item;

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

artbyrab\sinvoice\Totals Object
(
    [itemNetTotal:artbyrab\sinvoice\Totals:private] => 480
    [discount:artbyrab\sinvoice\Totals:private] => 0
    [itemDiscountTotal:artbyrab\sinvoice\Totals:private] => 0
    [discountTotal:artbyrab\sinvoice\Totals:private] => 0
    [shippingHandlingTotal:artbyrab\sinvoice\Totals:private] => 0
    [otherChargesTotal:artbyrab\sinvoice\Totals:private] => 0
    [netTotal:artbyrab\sinvoice\Totals:private] => 480
    [taxTotal:artbyrab\sinvoice\Totals:private] => 0
    [grossTotal:artbyrab\sinvoice\Totals:private] => 480
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
