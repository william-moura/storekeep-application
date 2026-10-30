<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller;
use Src\Products\Application\DTOs\CreateProductDto;
use Src\Products\Application\UseCases\CreateProductUseCase;
use Src\Products\Infrastructure\Http\Requests\CreateProductRequest;
use Illuminate\Http\JsonResponse;
class CreateProductController extends Controller
{
    public function __construct(
        private CreateProductUseCase $createProductUseCase
    ) {}
    /**
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $dto = CreateProductDto::fromRequest($request);
        return response()->json($this->createProductUseCase->execute($dto));
    }
}