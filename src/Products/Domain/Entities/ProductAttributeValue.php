<?php

namespace Src\Products\Domain\Entities;

final class ProductAttributeValue
{
    public function __construct(
        public readonly string $id,
        public readonly string $attributeId,
        public string $value // ex: "Azul", "1000W", "100V"
    ) {}

    public function equals(ProductAttributeValue $other): bool
    {
        return $this->id === $other->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'attribute_id' => $this->attributeId,
            'value' => $this->value,
        ];
    }
}