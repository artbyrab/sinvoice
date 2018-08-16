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

use Rabus\Sinvoice\Observer;

/**
 * Dummy Observer
 * 
 * This is a dummy observer implementation to assist in testing.
 *  
 * @author RABUS
 */
class DummyObserver implements Observer {

    CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE = 0;

    public $status = self::STATUS_INACTIVE;

    /**
     * Update
     * 
     * @return string
     */
    public function update ()
    {
        $this->status = self::STATUS_ACTIVE;
    }
}