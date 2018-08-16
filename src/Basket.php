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
 * like the invoice items and invoice charges. Both items and charges have 
 * similar functionality and therefore can both easily utilise the basket.
 * 
 * The basket allows you to add, remove, and delete items by their key.
 * 
 * @author RABUS
 */
class Basket {

    /**
     * @var object An instance of the ObserverSubjects model.
     */
    public $subjects;

    /**
     * @var array An array of items that get added to the basket
     */
    public $items = array();

    /**
     * Construct
     * 
     * This will set up the ObserverSubject and attach the observer to it, in 
     * this case the invoice. When the Basket is updated, with add, remove 
     * or clear the ObserverSubject will notify the invoice to update it's 
     * totals.
     * 
     * @param object $invoice An instance of the invoice model.
     * @return object 
     */
    public function __construct(Invoice $invoice) 
    {
        $this->subjects = new ObserverSubjects();
        $this->subjects->attach($invoice);
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
        $this->subjects->notify();
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
        $this->subjects->notify();
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
        $this->subjects->notify();
    }
}