<?php

namespace Src\Products\Infrastructure\Persistence\Repositories;

use Src\Products\Domain\Entities\ProductAttributeValue;
use Src\Products\Domain\Repositories\AttributeRepositoryInterface;
use Src\Products\Domain\Entities\ProductAttribute;
use Src\Products\Infrastructure\Persistence\Models\Attribute as AttributeModel;
use Src\Products\Infrastructure\Persistence\Models\AttributeValue as AttributeValueModel;

class AttributeRepository implements AttributeRepositoryInterface
{
    public function create(ProductAttribute $attribute): ProductAttribute
    {
        $attributeModel = AttributeModel::create($attribute->toArray());
        return new ProductAttribute($attributeModel->id, $attributeModel->name);
    }
    public function findAll(): array
    {
        return AttributeModel::all()->map(function (AttributeModel $attributeModel) {
            return new ProductAttribute($attributeModel->id, $attributeModel->name);
        })->toArray();
    }
    public function createValue(ProductAttributeValue $value): ProductAttributeValue
    {
        $valueModel = AttributeValueModel::create($value->toArray());
        return new ProductAttributeValue(
            id: $valueModel->id,
            attributeId: $valueModel->attribute_id,
            value: $valueModel->value
        );
    }
    public function findAllValues(): array
    {
        return AttributeValueModel::all()->map(function (AttributeValueModel $valueModel) {
            return new ProductAttributeValue($valueModel->id, $valueModel->attribute_id, $valueModel->value);
        })->toArray();
    }
    public function findById(string $id): ProductAttribute
    {
        $attributeModel = AttributeModel::find($id);
        if (!$attributeModel) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Attribute not found');
        }
        return new ProductAttribute($attributeModel->id, $attributeModel->name);
    }
}