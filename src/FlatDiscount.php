<?php
/**
 * Sinvoice an invoicing model.
 *
 * @package   Sinvoice
 * @author    artbyrab <contact@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in
 * this paackage.
 */

namespace artbyrab\sinvoice;

use artbyrab\sinvoice\AbstractDiscount;

/**
 * Flat Discount
 *
 * This will apply a flat discount to a model that can accept a discount via
 * a setDiscount() function.
 *
 * A flat discount is a figure that will be deducted from the total. For example
 * if we have an invoice with a netTotal of 100.00 and we apply a flat discount
 * of 20.00 the netTotal will now be 80.00.
 *
 * @author artbyrab contact@art-by-rab.com
 */
class FlatDiscount extends AbstractDiscount
{
    /**
     * Calculte the flat discount total
     *
     * @return integer
     */
    public function calculate($total=null)
    {
        return $this->figure;
    }
}
