<?php

namespace Src\Products\Domain\Repositories;

use Src\Products\Domain\Entities\ProductAttribute;
use Src\Products\Domain\Entities\ProductAttributeValue;

interface AttributeRepositoryInterface
{
    public function findById(string $id): ProductAttribute;
    public function create(ProductAttribute $attribute): ProductAttribute;
    public function findAll(): array;

    public function createValue(ProductAttributeValue $value): ProductAttributeValue;
    public function findAllValues(): array;
}