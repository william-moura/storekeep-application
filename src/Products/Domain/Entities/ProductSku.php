<?php

namespace Src\Products\Domain\Entities;

use InvalidArgumentException;
use Src\Products\Domain\ValueObjects\Ean;
use Src\Products\Domain\ValueObjects\Price;
use Src\Products\Domain\ValueObjects\SKU;

final class ProductSku
{
    /** @var ProductAttributeValue[] */
    private array $attributeValues = [];

    /** @var ProductImage[] */
    private array $images = [];

    public function __construct(
        public readonly string $id,
        private SKU $skuCode,
        private Ean $ean,
        private Price $price,
        private int $stock
    ) {
        if ($price < 0) {
            throw new InvalidArgumentException("O preço do SKU não pode ser negativo.");
        }
        if ($stock < 0) {
            throw new InvalidArgumentException("O estoque inicial não pode ser negativo.");
        }
    }

    public function getSkuCode(): SKU
    {
        return $this->skuCode;
    }

    public function getEan(): Ean
    {
        return $this->ean;
    }

    public function getPrice(): float
    {
        return $this->price->getAmount();
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function addAttributeValue(ProductAttributeValue $value): void
    {
        foreach ($this->attributeValues as $existing) {
            if ($existing->equals($value)) {
                return;
            }
        }
        $this->attributeValues[] = $value;
    }

    /** @return ProductAttributeValue[] */
    public function getAttributeValues(): array
    {
        return $this->attributeValues;
    }

    public function addImage(ProductImage $image): void
    {
        $this->images[] = $image;
    }

    /** @return ProductImage[] */
    public function getImages(): array
    {
        return $this->images;
    }

    public function updateStock(int $newStock): void
    {
        if ($newStock < 0) {
            throw new InvalidArgumentException("O estoque não pode ser negativo.");
        }
        $this->stock = $newStock;
    }
}
