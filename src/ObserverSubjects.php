<?php

/**
 * Sinvoice an invoicing model.
 *
 * @package   Sinvoice
 * @author    artbyrab <contact@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in
 * this paackage.
 */

namespace artbyrab\sinvoice;

/**
 * Observer Subjects
 *
 * The Basket model utilises the ObserverSubjects as it allows us to attach
 * an invoice as an observer to the basket. When the baskets gets updated it
 * then notifies the invoice so it can perform actions like re-calculating
 * its totals.
 *
 * This model utilises the observer pattern. It is the subject part of the
 * pattern.
 *
 * This model allow you to add observers to it, and then when something
 * happens they get notified.
 *
 * @author artbyrab
 */
class ObserverSubjects
{

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
