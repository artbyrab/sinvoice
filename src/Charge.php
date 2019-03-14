<?php

/**
 * Sinvoice an invoicing model.
 *
 * @package   Sinvoice
 * @author    artbyrab <contact@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in
 * this package.
 */

namespace artbyrab\sinvoice;

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
 *  - Additional handling fee
 *  - Other costs
 *
 * @author artbyrab
 */
class Charge
{
    
    /**
     * @var string $price The net cost of the charge.z
     */
    private $price;

    /**
     * @var string A description of the charge.
     */
    private $description;

    /**
     * Construct
     *
     * @return object $this Is the instance of the Total for the fluid
     * interface.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * Set the price.
     *
     * @param integer $price Is the price of the charge.
     * @return object $this An instance of the Charge item.
     */
    public function setPrice($price)
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
     * Set the discount
     *
     * @param string $description Is the charge description.
     * @return object $this An instance of the Charge item.
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
