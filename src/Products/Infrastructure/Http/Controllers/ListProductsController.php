<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Src\Products\Application\DTOs\ListProductDTO;
use Src\Products\Application\UseCases\ListProductsUseCase;

class ListProductsController extends Controller
{
    public function __construct(
        private ListProductsUseCase $listProductsUseCase
    ) {}
    public function __invoke(Request $request)
    {
        $dto = ListProductDTO::fromRequest($request);
        return response()->json($this->listProductsUseCase->execute($dto));
    }
}