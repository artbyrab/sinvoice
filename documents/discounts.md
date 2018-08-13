# Discounts 

With Sinvoice you can you cann apply discounts at item level and invoice level. In each case you can add 1 discounts per item/invoice. So with this flexibility you can easily have discounts to suit all potential use cases with the exception of compound discounts.

## Types of discounts
In Sinvoice there are two types of discounts:
* Flat discounts
    * The discount is a fixed amount taken off the item price total
        * Example:
            Item price total of 100.00 and a discount of 10.00 = item net total of 90.00
* Percentage discounts
    * The discount is a percentage calculated from the item price total
        * Example
            * Item price total of 100.00 and a discount of 50.00 = item net total of 50.00

## Adding a flat discount to an item
```
$item = (new Item())
    ->setPrice(85.00)
    ->setQuantity(1)
    ->addDiscount(
        (new FlatDiscount())
            ->setFigure(15.00)
);
```

## Adding a flat discont to an invoice
```
```

## Adding a percentage discount to an item
```
```

## Adding a percentage discount to an invoice
```
```