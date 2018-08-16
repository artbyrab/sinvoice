<?php
/**
 * Sinvoice an invoicing model.
 * 
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in 
 * this paackage.
 */

namespace Rabus\Sinvoice;

use Rabus\Sinvoice\AbstractDiscount;

/**
 * Percentage Discount
 * 
 * This will apply a percentage discount to a model that can accept a discount 
 * via a setDiscount() function.
 * 
 * A percentage discount will give a discount based on the netTotal of the 
 * model it is applied to. For example if you have an invoice with a net total 
 * of 100.00 and you apply a 10% discount the new net total will be 90.00.
 * 
 * @author RABUS rabus@art-by-rab.com
 */
class PercentageDiscount extends AbstractDiscount 
{
    /**
     * Calculate 
     * 
     * Calculate the percentage discount total.
     */
    public function calculate($total=null)
    {
        return round(($total / 100) * $this->figure, 2);
    }
}