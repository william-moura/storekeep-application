<?php

namespace Src\Products\Application\DTOs;

class CreateProductSkuDTO
{
    public function __construct(
        public string $skuCode,
        public string $ean,
        public float $price,
        public int $stock,
        public array $attributeValues,
    ) {}
}