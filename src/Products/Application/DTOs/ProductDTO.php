<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Domain\Entities\Product;
use Src\Products\Infrastructure\Persistence\Models\Product as ProductModel;

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
            price: $product->getSkus()[0]->getPrice(),
            stock: $product->getStockTotal(),
        );
    }
    public static function fromModel(ProductModel $product): self
    {
        dd($product);
        return new self(
            name: $product->name,
            description: $product->description,
            price: $product->skus[0]->price,
            stock: $product->stock,
        );
    }
}