<?php

namespace Src\Products\Domain\Entities;

use InvalidArgumentException;
use Src\Products\Domain\Entities\ProductAttributeValue;

final class ProductAttribute
{
    /** @var ProductAttributeValue[] */
    private array $values = [];

    public function __construct(
        public readonly string $id,
        private string $name // ex: "Cor", "Tamanho", "Voltagem"
    ) {
        if (empty(trim($name))) {
            throw new InvalidArgumentException("O nome do atributo não pode ser vazio.");
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Cria e adiciona um valor válido atrelado diretamente a este tipo de atributo.
     * (Isso garante consistência: você não consegue criar um valor solto sem um tipo pai)
     */
    public function addValue(string $valueId, string $valueName): ProductAttributeValue
    {
        if (empty(trim($valueName))) {
            throw new InvalidArgumentException("O valor do atributo não pode ser vazio.");
        }

        $attributeValue = new ProductAttributeValue(
            id: $valueId,
            attributeName: $this->name,
            value: $valueName
        );

        $this->values[] = $attributeValue;

        return $attributeValue;
    }

    /** 
     * @return ProductAttributeValue[] 
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
