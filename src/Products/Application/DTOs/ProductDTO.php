<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Domain\Entities\Product;

class ProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $stock,
    ) {}

    public static function fromEntity(Product $product): self
    {
        return new self(
            name: $product->getName(),
            description: $product->getDescription(),
            price: $product->getSku()->getPrice()->getValue(),
            stock: $product->getSku()->getStock(),
        );
    }
    
}