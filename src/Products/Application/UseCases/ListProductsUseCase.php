<?php

namespace Src\Products\Application\UseCases;

use Src\Products\Application\DTOs\ProductDTO;
use Src\Products\Domain\Entities\Product;
use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Application\DTOs\ListProductDTO;
use Src\Products\Infrastructure\Persistence\Models\Product as ProductModel;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProductsUseCase
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ) {}
    public function execute(ListProductDTO $dto): LengthAwarePaginator
    {
        $perPage = 10;
        if ($dto->page !== null) {
            $perPage = $dto->perPage ?? 10;
            if ($perPage <= 0) {
                $perPage = 10;
            }            
        }
        $products = $this->repository->paginate($dto->search, $dto->page, $perPage);        
        return $products->through(fn (Product $product) => ProductDTO::fromEntity($product));        
    }
}