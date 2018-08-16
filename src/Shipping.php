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
     * @var integer Price is the net cost of the shipping.
     */
    private $price;

    /**
     * Delivery date
     * 
     * The delivery date for the shipping. 
     * 
     * @var string
     */
    private $deliveryDate;

    /**
     * Handler
     * 
     * The handler can be the shipping company who will deliver to your
     * customer/recipient.
     * 
     * @var string
     */
    private $handler;

    /**
     * Reference
     * 
     * If you want to attach a unique reference to the shipping.
     * 
     * @var string
     */
    private $reference;

    /**
     * Construct
     * 
     * @return object $this Is the instance of the Total for the fluid 
     * interface.
     */
    public function __construct($parameters = array()) 
    {
        return $this;
    }

    /**
     * Add recipient
     * 
     * @param integer $recipient is an instance of the Entity model.
     */
    public function addRecipient(Entity $recipient)
    {
        $this->recipient = $recipient;

        return $this;
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
     * Set the deliveryDate
     *
     * @param string $deliveryDate
     */
    public function setDeliveryDate($date)
    {
        $date = new DateTime($date);

        $this->deliveryDate = $date->format('Y-m-d');

        return $this;
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

        return $this;
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

        return $this;
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