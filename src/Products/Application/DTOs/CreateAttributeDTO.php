<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Infrastructure\Http\Requests\CreateAttributeRequest;

class CreateAttributeDTO
{
    public function __construct(
        public string $name
    ) {}

    public static function fromRequest(CreateAttributeRequest $request): self
    {
        return new self($request->validated('name'));
    }
}