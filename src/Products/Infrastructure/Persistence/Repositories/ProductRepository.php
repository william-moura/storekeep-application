<?php

namespace Src\Products\Infrastructure\Persistence\Repositories;

use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Infrastructure\Persistence\Models\Product as ProductModel;
use Src\Products\Domain\Entities\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(Product $product): void
    {
        ProductModel::create($product->toArray());
    }

    public function update(Product $product): void
    {
        ProductModel::where('id', $product->id)->update($product->toArray());
    }

    public function delete(Product $product): void
    {
        ProductModel::where('id', $product->id)->delete();
    }

    public function findById(string $id): ?Product
    {
        $product = ProductModel::find($id);
        return $product ? new Product($product->id, $product->name, $product->description) : null;
    }

    public function findAll(): array
    {
        return ProductModel::all()->map(function ($product) {
            return new Product($product->id, $product->name, $product->description);
        })->toArray();
    }
}