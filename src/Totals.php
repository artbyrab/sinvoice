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
 * Invoice Totals
 * 
 * This will simply calculate the totals for an instance of the Invoice model.
 * 
 * The Total model will be automatically instantiated in the construct
 * for the Invoice model.
 *  
 * @author RABUS
 */
class Totals {

    /**
     * @var integer Is the total of all the items net totals.
     */
    private $itemNetTotal;

    /**
     * @var integer Is the invoice level discount. 
     */
    private $discount;
    
    /**
     * @var integer Is the total of all the item discounts.
     */
    private $itemDiscountTotal;
    
    /**
     * @var integer Is the total of the item discount total and the invoice 
     * level discount.
     */
    private $discountTotal;
    
    /**
     * @var integer Is the total of the shipping and handling.
     */
    private $shippingHandlingTotal;
    
    /**
     * @var integer Is the total of any other charges on the invoice.
     */
    private $otherChargesTotal;

    /**
     * @var integer Is the total of the invoice sans the tax.
     */
    private $netTotal;

    /**
     * @var integer Is the net total divided by 100 multiplied by the invoice
     * tax percentage.
     */
    private $taxTotal;
    
    /**
     * @var integer Gross total is the net total with tax added on.
     */
    private $grossTotal;

    /**
     * Construct
     * 
     * @return object $this Is the instance of the Total for the fluid 
     * interface.
     */
    public function __construct()
    {
        $this->setDefaultTotals();
        return $this;
    }

    /**
     * Get item net total
     */
    public function getItemNetTotal()
    {
        return $this->itemNetTotal;
    }

    /**
     * Get discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Get item discount totaltReferenc
     */
    public function getItemDiscountTotal()
    {
        return $this->itemDiscountTotal;
    }

    /**
     * Get discount total
     */
    public function getDiscountTotal()
    {
        return $this->discountTotal;
    }

    /**
     * Get shipping and handling total
     */
    public function getShippingHandlingTotal()
    {
        return $this->shippingHandlingTotal;
    }

    /**
     * Get other charges total
     */
    public function getOtherChargesTotal()
    {
        return $this->otherChargesTotal;
    }

    /**
     * Get net total
     */
    public function getNetTotal()
    {
        return $this->netTotal;
    }

    /**
     * Get net total
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * Get gross total
     */
    public function getGrossTotal()
    {
        return $this->grossTotal;
    }

    /**
     * Set Default Totals
     */
    public function setDefaultTotals()
    {
        $this->itemNetTotal = 0.00;
        $this->discount = 0.00;
        $this->itemDiscountTotal = 0.00;
        $this->discountTotal = 0.00;
        $this->shippingHandlingTotal = 0.00;
        $this->otherChargesTotal = 0.00;
        $this->netTotal = 0.00;
        $this->taxTotal = 0.00;
        $this->grossTotal = 0.00;
    }

    /**
     * Calculate totals
     * 
     * @TODO needs refactoring - RAB
     * 
     * @param object $invoice Is an instance of the Invoice model.
     */
    public function calculateTotals($invoice)
    {
        $this->setDefaultTotals();

        if (!empty($invoice->items->getItems())) {
            foreach ($invoice->items->getItems() as $item){
                $this->itemDiscountTotal = $this->itemDiscountTotal + $item->getDiscount(); 
                $this->itemNetTotal = $this->itemNetTotal + $item->getNetTotal(); 
                $this->netTotal = $this->netTotal + $item->getNetTotal();
            }

            if (!empty($invoice->shipping)) {
                $this->shippingHandlingTotal = $invoice->shipping->getPrice();
            }

            $this->itemDiscountTotal = round($this->itemDiscountTotal, 2);
            $this->itemNetTotal = round($this->itemNetTotal, 2);

            if ($invoice->discount !== null or !empty($invoice->discount)) {
                $this->discount = $invoice->discount->calculate($this->itemNetTotal);
            }

            $this->discountTotal = $this->itemDiscountTotal + $this->discount;
            $this->netTotal = round($this->netTotal + $this->shippingHandlingTotal + $this->otherChargesTotal - $this->discount, 2);
            $this->taxTotal = round(($this->netTotal/100) * $invoice->getTaxPercentage(), 2);
            $this->grossTotal = $this->netTotal + $this->taxTotal;
        }
    }
}