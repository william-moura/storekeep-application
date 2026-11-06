<?php

namespace Src\Products\Application\DTOs;

use Src\Products\Infrastructure\Http\Requests\CreateAttributeValueRequest;

class CreateAttributeValueDTO
{
    public function __construct(
        public string $attributeId,
        public string $value,
    ) {}

    public static function fromRequest(CreateAttributeValueRequest $request): CreateAttributeValueDTO
    {
        return new CreateAttributeValueDTO(
            attributeId: $request->attribute_id,
            value: $request->value,
        );
    }
}