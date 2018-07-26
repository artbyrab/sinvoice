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
use Rabus\Sinvoice\Entity;

/**
 * Customer
 * 
 * A customer is the recipient of the invoice. Please note the if the customer
 * is getting a delivery then you will need to also complete a shipping 
 * and recipient object.
 * 
 * This class extends the entity class.
 *  
 * @author RABUS
 */
class Customer extends Entity 
{
    /**
     * @var string
     */
    private $account;

    public function __construct($parameters = array()) 
    {
        $this->entity = new Entity();
        foreach($parameters as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Get the customer details formatted as a string
     * 
     * This will always use the following:
     *  - name
     *  - address
     * 
     * This function will optionally use the following if they are not empty:
     *  - shipping address
     *  - phone
     *  - email
     *  - account 
     * 
     * @param string $seperator Is the seperated between values.
     */
    public function formatToString(string $seperater = ", ")
    {
        $customer = '';
        if (!empty($name)) {
            $customer = $customer . $name . $seperater;
        }
        if (!empty($address)) {
            $customer = $customer . $address . $seperater;
        }
        if (!empty($phone)) {
            $customer = $customer . $phone . $seperater;
        }
        if (!empty($email)) {
            $customer = $customer . $email . $seperater;
        }
        if (!empty($account)) {
            $customer = 'Account: ' . $customer . $account . $seperater;
        }

        return $customer;
    }

    /**
     * Set the email
     *
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}