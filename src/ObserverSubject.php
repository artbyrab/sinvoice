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
 * Observer Subject
 * 
 * The observer subject allows you to add a single observer to another object
 * and the observer gets notified when the object gets updated.
 * 
 * Resources
 * - https://codeburst.io/observer-pattern-object-oriented-php-4e669431bcb9?gi=ff9384165a14
 * - https://secure.php.net/manual/en/function.spl-object-hash.php
 *  
 * @author RABUS
 */
class ObserverSubject {

    public $observer=Null;

    /**
     * Attach an observer
     * 
     * @param object $observer is whatever object you are attaching.
     */
    public function attach($observer)
    {
        $this->observer = $observer;
    }

    /**
     * Detach an observer
     */
    public function detach()
    {
        $this->observer=Null;
    }

    /**
     * Notify 
     * 
     * @return void 
     */
    public function notify()
    {
        if ($this->observer != Null) {
            $this->observer->update();
        }
    }

}