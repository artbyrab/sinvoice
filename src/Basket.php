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
 * @TODO add description
 * 
 * https://codeburst.io/observer-pattern-object-oriented-php-4e669431bcb9?gi=ff9384165a14
 *  
 * @author RABUS
 */
class Basket {

    public $invoice = Null;

    public $items = array();

    /**
     * Attach an Invoice
     * 
     * An invoice needs to be attached so that the total of the invoice can 
     * be updated when items are added and removed from the basket.
     * 
     * @param object $invoice Is an instance of the Invoice model.
     */
    public function attachInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Detach an Invoice
     * 
     * @param object $invoice Is an instance of the Invoice model.
     */
    public function detachInvoice()
    {
        $this->invoice=Null;
    }

    /**
     * Notify the invoice
     * @return void 
     */
    public function notify()
    {
        //$this->invoice->update();
    }

    /**
     * Add an item to the basket
     *
     * @param object $item is an Item object being added to the items array.
     */
    public function addItem(Item $item)
    {
        array_push($this->items, $item);
        $this->notify();
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
        $this->notify();
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
        $this->notify();
    }

}