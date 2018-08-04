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
 * Entity 
 * 
 * An entity can be a company/organisation or a person. When creating 
 * customers, suppliers and recipients you can use the entity model.
 *  
 * @author RABUS
 */
class Entity {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $reference;

    /**
     * Construct
     * 
     * @param array $parameters Pass any of the models attributes while 
     * constructing.
     */
    public function __construct($parameters = array()) 
    {
        foreach($parameters as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * Get the entitys details formatted
     * 
     * @param string $name
     */
    public function formatToString(string $seperater = ", ")
    {
        $string = '';

        foreach ($this as $key => $value) {
            if (!empty($value)) {
                $string = $string . $value . $seperater;
            }
        }
        $string = rtrim($string, $seperater);
        
        return $string;
    }

    /**
     * Set the name
     * 
     * @param string $name
     * @return object $this Is the instance of the Entity.
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the address
     *
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the phone
     *
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the email
     *
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
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

    /**
     * Set the reference
     *
     * @param string|integer $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the reference
     *
     * @return string|integer
     */
    public function getReference()
    {
        return $this->reference;
    }
}