<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Src\Products\Application\UseCases\ListAttributeValuesUseCase;

class ListAttributeValuesController extends Controller
{
    public function __construct(
        private ListAttributeValuesUseCase $listAttributeValuesUseCase
    ) {}

    public function __invoke(): JsonResponse
    {
        return response()->json($this->listAttributeValuesUseCase->execute());
    }
}