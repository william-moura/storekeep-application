<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Infrastructure\Http\Requests\CreateProductRequest;

class CreateProductDto
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
    ) {}

    public static function fromRequest(CreateProductRequest $request): self
    {
        return new self(
            name: $request->name,
            description: $request->description,
            price: $request->price,
        );
    }
}