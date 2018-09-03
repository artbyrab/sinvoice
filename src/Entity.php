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
 * Don't leave your Sinvoices lonely. Why not make them happy by adding some
 * entities to them.
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
     * @return object An instance of this model.
     */
    public function __construct() 
    {
        return $this;
    }

    /**
     * Get the entitys details formatted
     * 
     * @param string $name
     */
    public function formatToString(string $seperator = ", ")
    {
        $string = '';

        foreach ($this as $key => $value) {
            if (!empty($value)) {
                $string = $string . $value . $seperator;
            }
        }
        
        $string = rtrim($string, $seperator);

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