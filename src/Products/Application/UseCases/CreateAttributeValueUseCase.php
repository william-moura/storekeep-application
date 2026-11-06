<?php

namespace Src\Products\Application\UseCases;

use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Src\Products\Application\DTOs\CreateAttributeValueDTO;
use Src\Products\Domain\Entities\ProductAttributeValue;
use Src\Products\Domain\Repositories\AttributeRepositoryInterface;

class CreateAttributeValueUseCase
{
    public function __construct(
        private AttributeRepositoryInterface $attributeRepository
    ) {}

    public function execute(CreateAttributeValueDTO $dto): ProductAttributeValue
    {
        $attribute = $this->attributeRepository->findById($dto->attributeId);
        if (!$attribute) {
            throw new \Exception('Attribute not found');
        }
        return $this->attributeRepository->createValue(new ProductAttributeValue(
            id: Uuid::uuid4()->toString(),
            attributeId: $dto->attributeId,
            value: $dto->value
        ));
    }
}