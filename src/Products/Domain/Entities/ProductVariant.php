<?php

namespace App\Products\Domain\Entities;

use App\Products\Domain\ValueObjects\SKU;
use App\Products\Domain\ValueObjects\Price;

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