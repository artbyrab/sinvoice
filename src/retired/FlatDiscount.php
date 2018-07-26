<?php

class FlatDiscount implements DiscountInterface 
{
    
    private $figure;
    private $description;

    public function __construct($figure, $description=null)
    {
        $this->figure = round($figure, 2);
        if (!empty($description)) {
            $this->description = $description
        }
    }

    public function calculate($total)
    {
        return $total - $this->figure;
    }
}