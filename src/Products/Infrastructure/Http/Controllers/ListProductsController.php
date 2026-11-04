<?php

namespace Src\Products\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller;

class ListProductsController extends Controller
{
    public function __invoke()
    {
        return response()->json([]);
    }
}