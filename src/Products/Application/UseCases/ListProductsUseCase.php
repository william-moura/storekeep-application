<?php

namespace Src\Products\Application\UseCases;

use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Application\DTOs\ListProductDTO;

class ListProductsUseCase
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ) {}
    public function execute(ListProductDTO $dto): array
    {
        $perPage = 10;
        if ($dto->page !== null) {
            $perPage = $dto->perPage ?? 10;
            if ($perPage <= 0) {
                $perPage = 10;
            }            
        }
        $products = $this->repository->paginate($dto->search, $dto->page, $perPage);        
        return [
            'data' => $products->items(),
            'total' => $products->total(),
            'page' => $products->currentPage(),
            'perPage' => $products->perPage(),
        ];
    }
}