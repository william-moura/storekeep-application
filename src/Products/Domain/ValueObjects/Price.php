<?php

namespace Src\Products\Domain\ValueObjects;

use InvalidArgumentException;

class Price
{
    private float $amount;    

    public function __construct(float $amount, string $currency)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must be greater than 0');
        }
        $this->amount = round($amount, 2);        
    }
    public function getAmount(): float
    {
        return $this->amount;
    }
    
}