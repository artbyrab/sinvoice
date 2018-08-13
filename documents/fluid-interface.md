# Fluid Interface

With Sinvoice you can create your objects using a fluid interface. All that means is you can chain commands together as each function simply return itself. All objects in Sinvoice can be created with a fluid interface or a more traditional method.

So an example of creating an item with a fluid interface would be:
```
$item = (new Item())
    ->setName('Gladius Sword')
    ->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.')
    ->setPrice(120.00)
    ->setQuantity(4);
    ->addDiscount(
        (new FlatDiscount())
            ->setFigure(10.00)
            ->setDescription('Regular customer discount')
    )

```
If you were to do it in a more traditional way it would look as below:
```

$item = new Item();
$item->setName('Gladius Sword');
$item->setDescription('Very fine looking Gladius sword, suitable for decapitation or stabbing.');
$item->setPrice(120.00);
$item->setQuantity(4);

$discount = new FlatDiscount();
$discount->setFigure(10.00);
$discount->setDescription('Regular customer discount');

$item->addDiscount($discount);

```

