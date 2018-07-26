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

use \DateTime;

/**
 * Shipping
 * 
 * If an invoice/customer requires shipping you can simply add in a 
 * shipping model.
 *  
 * @author RABUS
 */
class Shipping {

    /**
     * @var object $recipient is an instance of the Entity model. The 
     * recipient may be the customer or another entity who is recieiving the
     * items sold in the invoice.
     * 
     * The recipients default is null. If there is no delivery then you do not
     * need to fill in the recipient.
     */
    public $recipient = null;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $deliveryDate;

    /**
     * @var string
     */
    private $handler;

    /**
     * @var string
     */
    private $reference;

    /**
     * Construct
     * 
     * @param array $parameters is an array of the attributes you wish to 
     * populate on construction.
     */
    public function __construct($parameters = array()) 
    {
        foreach($parameters as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Add recipient
     * 
     * @param integer $recipient is an instance of the Entity model.
     */
    public function addRecipient(Entity $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Get the recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->supplier->formatToString();
    }

    /**
     * Set the price. 
     * 
     * @param string $price
     */
    public function setPrice(string $price)
    {
        $this->price = $price;
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
     * Set the deliveryDate
     *
     * @param string $deliveryDate
     */
    public function setDeliveryDate($date)
    {
        $date = new DateTime($date);

        $this->deliveryDate = $date->format('Y-m-d');
    }

    /**
     * Get the deliveryDate
     *
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Set the handler
     *
     * @param string $handler
     */
    public function setHandler(string $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Get the handler
     *
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Set the reference
     *      
     * @param string $reference
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /**
     * Get the reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}