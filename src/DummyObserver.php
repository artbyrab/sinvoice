<?php

/**
 * Sinvoice an invoicing model.
 *
 * @package   Sinvoice
 * @author    artbyrab <contact@art-by-rab.com>
 * @link      @TODO add in link
 * For copyright and license please see LICENSE and README docs contained in
 * this package.
 */

namespace artbyrab\sinvoice;

use artbyrab\sinvoice\Observer;

/**
 * Dummy Observer
 *
 * This is a dummy observer implementation to assist in testing. It simply
 * allows you to set the status attribute to active or inactive to ensure the
 * notify > update function works as expected.
 *
 * @author artbyrab
 */
class DummyObserver implements Observer
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @var integer $status
     */
    public $status = self::STATUS_INACTIVE;

    /**
     * Update
     *
     * @return string
     */
    public function update()
    {
        $this->status = self::STATUS_ACTIVE;
    }
}
