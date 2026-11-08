<?php

namespace Src\Products\Application\UseCases;

use Src\Products\Domain\Repositories\AttributeRepositoryInterface;

class ListAttributeValuesUseCase
{
    public function __construct(
        private AttributeRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->findAllValues();
    }
}