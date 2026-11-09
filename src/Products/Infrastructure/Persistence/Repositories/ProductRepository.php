<?php

namespace Src\Products\Infrastructure\Persistence\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\Products\Domain\Entities\ProductAttributeValue;
use Src\Products\Domain\Entities\ProductSku;
use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Domain\ValueObjects\Ean;
use Src\Products\Domain\ValueObjects\Price;
use Src\Products\Domain\ValueObjects\SKU;
use Src\Products\Infrastructure\Persistence\Models\AttributeValue;
use Src\Products\Infrastructure\Persistence\Models\Product as ProductModel;
use Src\Products\Domain\Entities\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(Product $product): Product
    {
        $productModel = ProductModel::create($product->toArray());
        
        foreach ($product->getSkus() as $sku) {
            $skuModel = $productModel->skus()->create([
                'id' => $sku->id,
                'sku_code' => $sku->getSkuCode()->getCode(),
                'ean' => $sku->getEan()->toString(),
                'price' => $sku->getPrice(),
                'stock' => $sku->getStock(),
            ]);
            if (!empty($sku->getAttributeValues())) {
                
                $skuModel->attributeValues()->sync($sku->getAttributeValues());
            }
        }
        return new Product(
            id: $productModel->id,
            name: $productModel->name,
            description: $productModel->description,
            // skus: array_map(function ($sku) {
            //     return new ProductSku(
            //         id: $sku->id,
            //         skuCode: new SKU($sku->sku_code),
            //         ean: new Ean($sku->ean),
            //         price: new Price($sku->price, 'BRL'),
            //         stock: $sku->stock,
            //         attributeValues: array_map(function ($attributeValue) {
            //             return new ProductAttributeValue($attributeValue->id, $attributeValue->attribute_id, $attributeValue->value);
            //         }, $sku->attributeValues),
            //     );
            // }, $productModel->skus),
        );
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
    public function paginate(string $search = '', int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return ProductModel::query()
        ->where('name', 'like', "%$search%")
        ->with(['skus', 'skus.attributeValues'])
        ->skip(($page - 1) * $perPage)
        ->take($perPage)
        ->paginate($perPage)
        ->through(fn (ProductModel $product) => $this->convertToEntity($product));
    }

    private function convertToEntity(ProductModel $product): Product
    {
        $productEntity = new Product(
            id: $product->id,
            name: $product->name,
            description: $product->description,
        );
        foreach ($product->skus as $sku) {            
            $productEntity->addSku(new ProductSku(
                id: $sku->id,
                skuCode: new SKU($sku->sku_code),
                ean: new Ean($sku->ean),
                price: new Price($sku->price, 'BRL'),
                stock: $sku->stock,
                attributeValues: $sku->attributeValues->map(fn (AttributeValue $attributeValue) => new ProductAttributeValue($attributeValue->id, $attributeValue->attribute_id, $attributeValue->value))->toArray(),
            ));
        }
        return $productEntity;
    }
}