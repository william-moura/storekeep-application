<?php

namespace Src\Products\Application\UseCases;

use Ramsey\Uuid\Uuid;
use Src\Products\Application\DTOs\CreateProductDto;
use Src\Products\Domain\Entities\Product;
use Src\Products\Domain\Repositories\ProductRepositoryInterface;

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
            description: $dto->description
        );
        return $this->productRepository->create($product);
    }
}