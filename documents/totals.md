# Totals

The totals are a seperate model, but really you do not need to do much with them. The only part of the totals you may need is the other charges total.

## Breakdown of the totals
Below is a breakdown of all the totals in the total model.
* Item Net Total
    * Is the total of all the items net total on the invoice
* Discount
    * Is the invoice level discount
* Item Discount Total
    * Is the total of all the item discounts
* Discount Total
    * Is the combined total of the Discount and Item Discount Total
    * This is useful as behind the scenes you may want to understand the total discounts you are giving to customers
* Shipping Handling Total
    * Is the total from the invoice shipping model
* Other Charges Total
    * Any additional charges you wish to apply for the customer
* Net Total
    * Is the total of the invoice sans the tax
* Tax Total
    * Is the net total divided by 100 multiplied by the invoice tax percentage
* Gross Total
    * Gross total is the net total with tax added on

 ## Adding the other charges total
 ```
 ```

 ## ?