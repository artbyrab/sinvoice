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
 * The observer subjects allows you to add multiple observers to another object
 * and the observers get notified when the object gets updated.
 * 
 * Resources
 * - https://codeburst.io/observer-pattern-object-oriented-php-4e669431bcb9?gi=ff9384165a14
 * - https://secure.php.net/manual/en/function.spl-object-hash.php
 *  
 * @author RABUS
 */
class ObserverSubjects {

    public $observers=array();

    /**
     * Attach an observer
     * 
     * We will add the observer to the array and set its key as a hash of 
     * the object.
     * 
     * @param object $observer is whatever object you are attaching.
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
     */
    public function detach($observer)
    {
        $observerKey = spl_object_hash($observer);
        unset($this->observers[$observerKey]);
    }

    /**
     * Notify 
     * 
     * @return void 
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
           $observer->update();
        }
    }

}