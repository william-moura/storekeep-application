<?php

namespace Src\Products\Application\UseCases;

use Src\Products\Application\DTOs\CreateAttributeDTO;
use Src\Products\Domain\Entities\ProductAttribute;
use Src\Products\Domain\Repositories\AttributeRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CreateAttributeUseCase
{
    public function __construct(
        private AttributeRepositoryInterface $attributeRepository
    ) {}

    public function execute(CreateAttributeDTO $dto): ProductAttribute
    {
        $attribute = new ProductAttribute(Uuid::uuid4()->toString(), $dto->name);
        $attribute = $this->attributeRepository->create($attribute);
        return $attribute;
    }
}