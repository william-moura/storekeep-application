<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\Products\Application\DTOs\CreateAttributeValueDTO;
use Src\Products\Application\UseCases\CreateAttributeValueUseCase;
use Src\Products\Infrastructure\Http\Requests\CreateAttributeValueRequest;

class CreateAttributeValueController extends Controller
{
    public function __construct(
        private CreateAttributeValueUseCase $createAttributeValueUseCase
    ) {}

    public function __invoke(CreateAttributeValueRequest $request): JsonResponse
    {
        $dto = CreateAttributeValueDTO::fromRequest($request);
        return response()->json($this->createAttributeValueUseCase->execute($dto));
    }
}