<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\Products\Application\UseCases\ListAttributesUseCase;

class ListAttributesController extends Controller
{
    public function __construct(
        private ListAttributesUseCase $listAttributesUseCase
    ) {}

    public function __invoke(): JsonResponse
    {
        return response()->json($this->listAttributesUseCase->execute());
    }
}