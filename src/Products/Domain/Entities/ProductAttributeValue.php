<?php

namespace Src\Products\Domain\Entities;

final class ProductAttributeValue
{
    public function __construct(
        public readonly string $id,
        public readonly string $attributeName,
        public readonly string $value
    ) {}

    public function equals(ProductAttributeValue $other): bool
    {
        return $this->id === $other->id;
    }
}