<?php

namespace Src\Products\Domain\ValueObjects;

use InvalidArgumentException;

final class Ean
{
    private string $value;

    public function __construct(string $value)
    {
        $cleanValue = preg_replace('/\D/', '', $value); // Remove caracteres não numéricos
        
        if (empty($cleanValue)) {
            throw new InvalidArgumentException("O código EAN não pode ser vazio.");
        }
        
        // EANs comuns têm 8, 13 ou 14 dígitos
        $length = strlen($cleanValue);
        if (!in_array($length, [8, 13, 14])) {
            throw new InvalidArgumentException("O código EAN deve conter 8, 13 ou 14 dígitos numéricos.");
        }

        $this->value = $cleanValue;
    }

    public function toString(): string
    {
        return $this->value;
    }
}