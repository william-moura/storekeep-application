<?php

namespace Src\Products\Domain\ValueObjects;

use InvalidArgumentException;

class SKU
{
    private string $code;

    public function __construct(string $code)
    {
        if (empty(trim($code))) {
            throw new InvalidArgumentException('SKU must not be empty');
        }
        $this->code = strtoupper(trim($code));
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function toString(): string
    {
        return $this->code;
    }
}