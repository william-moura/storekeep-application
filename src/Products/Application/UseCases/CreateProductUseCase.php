<?php

namespace Src\Products\Application\UseCases;

use Ramsey\Uuid\Uuid;
use Src\Products\Application\DTOs\CreateProductDto;
use Src\Products\Domain\Entities\Product;
use Src\Products\Domain\Entities\ProductSku;
use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Domain\ValueObjects\Ean;
use Src\Products\Domain\ValueObjects\Price;
use Src\Products\Domain\ValueObjects\SKU;

class CreateProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
    public function execute(CreateProductDto $dto)
    {
        $product = new Product(
            id: Uuid::uuid4(),
            name: $dto->name,
            description: $dto->description,
        );
        foreach ($dto->skus as $sku) {
            $product->addSku(new ProductSku(
                id: Uuid::uuid4(),
                skuCode: new SKU($sku->skuCode),
                ean: new Ean($sku->ean),
                price: new Price($sku->price, 'BRL'),
                stock: $sku->stock,
                attributeValues: $sku->attributeValues,
            ));
        }
        return $this->productRepository->create($product);
        // $product = $this->productRepository->create(new Product(
        //     id: Uuid::uuid4(),
        //     name: $dto->name,
        //     description: $dto->description,
        // ));
        // foreach ($dto->skus as $sku) {
        //     $product->addSku(new ProductSku(
        //         id: Uuid::uuid4(),
        //         skuCode: $sku->skuCode,
        //         ean: $sku->ean,
        //         price: $sku->price,
        //         stock: $sku->stock,
        //     ));
        //     foreach ($sku->attributeValues as $attributeValue) {
        //         $product->addAttributeValue(new ProductAttributeValue(
        //             id: Uuid::uuid4(),
        //             attributeId: $attributeValue->attributeId,
        //             value: $attributeValue->value,
        //         ));
        //     }
        // }
        return $product;
    }
}