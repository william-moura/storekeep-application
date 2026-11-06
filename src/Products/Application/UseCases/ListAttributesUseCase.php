<?php

namespace Src\Products\Application\UseCases;

use Src\Products\Domain\Repositories\AttributeRepositoryInterface;

class ListAttributesUseCase
{
    public function __construct(
        private AttributeRepositoryInterface $attributeRepository
    ) {}

    public function execute(): array
    {
        return $this->attributeRepository->findAll();
    }
}