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
 * Observer Subjects
 * 
 * This model utilises the observer pattern. It is the subject part of the 
 * pattern.
 * 
 * This model allow you to add observers to it, and then when something 
 * happens they get notified.
 * 
 * In this case the observers are singular and are an invoice. And the 
 * observer subject is a basket which notifies the invoice whenever an item is 
 * added or removed. This is specifically to ensure the invoice totals get 
 * recalculated after an invoice item is added.
 * 
 * @author RABUS
 */
class ObserverSubjects {

    /**
     * @var array $observers is an array of objects that implement the 
     * Observer interface.
     */
    public $observers=array();

    /**
     * Attach an observer
     * 
     * We will add the observer to the array and set its key as a hash of 
     * the object.
     * 
     * @param object $observer is whatever object you are attaching that 
     * implements the Observer interface.
     */
    public function attach($observer)
    {
        $observerKey = spl_object_hash($observer);
        $this->observers[$observerKey] = $observer;
    }

    /**
     * Detach an observer
     * 
     * Detaching is as simple as just passing the object which gets removed 
     * by its hash.
     * 
     * @param object $observer is whatever object you are detaching that 
     * implements the Observer interface.
     */
    public function detach($observer)
    {
        $observerKey = spl_object_hash($observer);
        unset($this->observers[$observerKey]);
    }

    /**
     * Notify 
     * 
     * For each observer we will trigger their update function.
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
           $observer->update();
        }
    }
}