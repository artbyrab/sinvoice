<?php
/**
 * Sinvoice an invoicing model.
 * 
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in 
 * this package.
 */

namespace Rabus\Sinvoice;

/**
 * Discount Interface
 * 
 * All discounts should implement this interface as the FlatDiscount model and
 * PercentageDiscount model do.
 * 
 * We have 2 places where discounts can be applied in the Sinvoice package, the 
 * Invoice model and the Item model. By allowing discounts at both levels we 
 * give maximum flexibility to the invoice creator.
 * 
 * If you want to create a new discount type model, you should create a model 
 * that implements it.
 *
 * @author RABUS rabus@art-by-rab.com
 */
interface DiscountInterface 
{
    /**
     * Calculate the discount total depending on the method you will implement
     * 
     * @param $total is the total of whatever you are calculating, either
     * an item or an invoice.
     */
    public function calculate($total=null);

    /**
     * Set the discount figure
     * 
     * @param integer $figure can be the flat or discount figure depending on
     * which implementation of the DiscountInteface you are using.
     */
    public function setFigure($figure);

    /**
     * Get the discount figure
     */
    public function getFigure();

    /**
     * Set the description
     * 
     * @param string $description Is the text description of the discount.
     */
    public function setDescription($description);

    /**
     * Get the description 
     */
    public function getDescription();
}