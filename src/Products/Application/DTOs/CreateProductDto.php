<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Domain\Entities\ProductSku;
use Src\Products\Infrastructure\Http\Requests\CreateProductRequest;

class CreateProductDto
{
    public function __construct(
        public string $name,
        public string $description,        
        public array $skus,
    ) {}

    public static function fromRequest(CreateProductRequest $request): self
    {
        return new self(
            name: $request->name,
            description: $request->description,
            skus: array_map(function ($sku) {
                return new CreateProductSkuDTO(
                    skuCode: $sku['sku_code'],
                    ean: $sku['ean'],
                    price: $sku['price'],
                    stock: $sku['stock'],
                    attributeValues: $sku['attribute_values'],
                );
            }, $request->skus),
        );
    }
}