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

use Rabus\Sinvoice\DiscountInterface;

/**
 * Abstract Discount
 * 
 * This provides a base class to build discounts upon.
 * 
 * This is designed to be extended by a discount model. For example with the 
 * FlatDiscount and the PercentageDiscount models.
 * 
 * If you want to create a new discount then you should extend this model. this 
 * model implements the DiscountInterface and adds some attributes to it to
 * allow for easier usage.
 * 
 * @author RABUS rabus@art-by-rab.com
 */
class AbstractDiscount implements DiscountInterface 
{
    /**
     * @var integer The discount figure, depending on the implementation this
     * might be a percentage of a flat figure.
     */
    protected $figure;

    /**
     * @var string A description of the discount.
     */
    protected $description;

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function calculate($total=null)
    {
        return $this->figure;
    }

    /**
     * {@inheritDoc}
     */
    public function setFigure($figure)
    {
        $this->figure = round($figure, 2);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFigure()
    {
        return $this->figure;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }
}