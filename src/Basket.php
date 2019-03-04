<?php

/**
 * Sinvoice an invoicing model.
 *
 * @package   Sinvoice
 * @author    RABUS <rabus@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in
 * this package.
 */

namespace Rabus\Sinvoice;

use Rabus\Sinvoice\ObserverSubjects;

/**
 * Basket
 *
 * A basket allows you to add, remove, and clear items. When an Invoice model
 * is instantiated some of its attributes like the items and charges will be
 * instances of the Basket model.
 *
 * We use the term item when adding items to the basket, but in Sinvoice terms
 * the item is either an Item model or a Charge model.
 *
 * The basket has a subject which is attached during its construction. The
 * subject is part of the observer pattern and is current Invoice model.
 *
 * The basket notifies it's subject when the basket gets updated. This
 * functionality is important to trigger things like total re-calculations
 * whenever an item is added or removed.
 *
 * @author RABUS
 */
class Basket
{

    /**
     * @var object An instance of the ObserverSubjects model, the subject in
     * typically an Invoice model. the subjects are watching the basket and will
     * be notified by the notify function if the basket gets updated. By updated
     * we mean having an item added, removed or cleared.
     */
    public $subjects;

    /**
     * @var array An array of items that get added to the basket All items
     * should be an instance of the Item model or Charge model.
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
     * @param object $item is an Item/Charge model being added to the items
     * array.
     */
    public function addItem(Item $item)
    {
        $itemKey = spl_object_hash($item);
        $this->items[$itemKey] = $item;

        $this->subjects->notify();
    }

    /**
     * Remove an item from the basket by its unique object hash.
     *
     * @param object $item is an Item/Charge model being removed from the items
     * array.
     */
    public function removeItem($item)
    {
        $itemKey = spl_object_hash($item);
        unset($this->items[$itemKey]);

        $this->subjects->notify();
    }

    /**
     * Get the current items in the basket
     *
     * @return array An array of Item/Charge models.
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
        unset($this->items);
        $this->items = array();

        $this->subjects->notify();
    }
}
