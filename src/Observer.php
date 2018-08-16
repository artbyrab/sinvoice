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
 * Observer interface
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