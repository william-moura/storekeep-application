<?php

namespace Src\Products\Domain\Entities;

use InvalidArgumentException;
use Src\Products\Domain\Entities\ProductSku;
use Src\Products\Domain\Entities\ProductImage;

final class Product
{
    /** @var ProductSku[] */
    private array $skus = [];

    /** @var ProductImage[] */
    private array $globalImages = [];

    public function __construct(
        public readonly string $id,
        private string $name,
        private string $description
    ) {
        if (empty(trim($name))) {
            throw new InvalidArgumentException("O nome do produto é obrigatório.");
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function addSku(ProductSku $sku): void
    {
        foreach ($this->skus as $existingSku) {
            if ($existingSku->getSkuCode()->toString() === $sku->getSkuCode()->toString()) {
                throw new InvalidArgumentException("Este SKU já está cadastrado para este produto.");
            }
            if ($existingSku->getEan()->toString() === $sku->getEan()->toString()) {
                throw new InvalidArgumentException("Este código EAN já está sendo usado por outro SKU deste produto.");
            }
        }
        $this->skus[] = $sku;
    }

    /** @return ProductSku[] */
    public function getSkus(): array
    {
        return $this->skus;
    }

    public function addGlobalImage(ProductImage $image): void
    {
        // Se a nova imagem for capa, remove o status de capa das anteriores na lista global
        if ($image->isCover()) {
            foreach ($this->globalImages as $existingImage) {
                $existingImage->removeCoverStatus();
            }
        }
        $this->globalImages[] = $image;
    }

    /** @return ProductImage[] */
    public function getGlobalImages(): array
    {
        return $this->globalImages;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}