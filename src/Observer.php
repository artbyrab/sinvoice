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
 * Observer Interface
 * 
 * This model utilises the observer pattern. It is the observer part of the 
 * pattern.
 * 
 * This model should be extended and then they should be attached to an 
 * instance of the ObserverSubject model. 
 * 
 * In this instance an observer will typically be an invoice. 
 * 
 * As the invoice model needs to be able to attach itself to an observer 
 * subject, we need to have a base interface to extend from.
 *  
 * @author RABUS
 */
interface Observer {

    /**
     * Update
     * 
     * Receive update from subject
     */
    public function update ();
}