<?php

namespace Src\Products\Domain\Repositories;

use Src\Products\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function create(Product $product): void;
    public function update(Product $product): void;
    public function delete(Product $product): void;
    public function findById(string $id): ?Product;
    public function findAll(): array;
    public function paginate(string $search = '', int $page = 1, int $perPage = 10): array;
}