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
 * Basket 
 * 
 * The basket is way for us to share functionality between invoice attributes 
 * like the invoice items and invoice charges. 
 * 
 * The basket allows you to add, remove, and delete items by their key.
 * 
 * @author RABUS
 */
class BasketObserver {

    /**
     * @var object An instance of the observer
     */
    public $observer;

    /**
     * @var array An array of items that get added to the basket
     */
    public $items = array();

    /**
     * Construct
     * 
     * @param object $invoice An instance of the invoice model.
     * @return object 
     */
    public function __construct(Invoice $invoice) 
    {
        $this->observer = new ObserverSubject();
        $this->observer->attach($invoice)
        return $this;
    }

    /**
     * Add an item to the basket
     *
     * @param object $item is an Item object being added to the items array.
     */
    public function addItem(Item $item)
    {
        array_push($this->items, $item);
        $this->observer->notify();
    }

    /**
     * Remove an item from the basket by its key.
     * 
     * @TODO 
     *
     * @param int $key is the invoice items key
     */
    public function removeItem($key)
    {
        unset($this->items[$key]);
        $this->observer->notify();
    }

    /**
     * Get the current items in the basket
     *
     * @return array An array of Item models.
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Clear all the current items
     */
    public function clearItems()
    {
        $this->items = array();
        $this->observer->notify();
    }

}