<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Src\Products\Application\DTOs\CreateAttributeDTO;
use Src\Products\Application\UseCases\CreateAttributeUseCase;
use Src\Products\Infrastructure\Http\Requests\CreateAttributeRequest;

class CreateAttributeController extends Controller
{
    public function __construct(
        private CreateAttributeUseCase $createAttributeUseCase
    ) {}

    public function __invoke(CreateAttributeRequest $request): JsonResponse
    {
        $dto = CreateAttributeDTO::fromRequest($request);
        return response()->json($this->createAttributeUseCase->execute($dto));
    }
}