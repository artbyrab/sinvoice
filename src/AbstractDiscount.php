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

use Rabus\Sinvoice\DiscountInterface;

/**
 * Abstract Discount
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
     * @var integer The percentage figure.
     */
    private $figure;

    /**
     * @var string A description of the discount.
     */
    private $description;

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
        $this->figure = $figure;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFigure()
    {
        return $this;
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
        return $this->description
    }
}