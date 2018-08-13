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

/**
 * Charge
 * 
 * A charge is simply an object that allows you to add a price and description
 * which can then be added to an invoice or other items. For example if there 
 * are some additional fees for the invoice that you do not want to add as an 
 * invoice item then a charge is the way to go.
 * 
 * Examples:
 *  - Additional Shipping charge
 *  - Handling fee
 *  - Other costs
 *  
 * @author RABUS
 */
class Charge {
    
    /**
     * Price
     * 
     * The net cost of the charge.
     * 
     * @var string
     */
    private $price;

    /**
     * @var string A description of the charge.
     */
    private $description;

    /**
     * Construct
     * 
     * @param array $parameters is an array of the attributes you wish to 
     * populate on construction.
     * @return object $this Is the instance of the Total for the fluid 
     * interface.
     */
    public function __construct($parameters = array()) 
    {
        foreach($parameters as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    /**
     * Set the price. 
     * 
     * @param string $price
     */
    public function setPrice(string $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
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