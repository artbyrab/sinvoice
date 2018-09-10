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
 * The invoice model implements this interface so we can attach it to other 
 * models which in turn can notify the invoice.
 * 
 * This model utilises the observer pattern and is the observer part of the 
 * pattern. The other part is the subject.
 * 
 * This model should be extended and then they should be attached to an 
 * instance of the ObserverSubject model. 
 * 
 * In this instance an observer will typically be an invoice. 
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