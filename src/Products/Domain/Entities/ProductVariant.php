<?php

namespace Src\Products\Domain\Entities;

use Src\Products\Domain\ValueObjects\SKU;
use Src\Products\Domain\ValueObjects\Price;

class ProductVariant
{
    private string $id;
    private Product $product;
    private SKU $sku;
    private Price $price;
    private string $color;
    private string $size;
    private int $stockQuantity;
    private ?string $description;
}