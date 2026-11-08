<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Src\Products\Infrastructure\Http\Controllers\CreateAttributeController;
use Src\Products\Infrastructure\Http\Controllers\CreateAttributeValueController;
use Src\Products\Infrastructure\Http\Controllers\CreateProductController;
use Src\Products\Infrastructure\Http\Controllers\ListAttributesController;
use Src\Products\Infrastructure\Http\Controllers\ListAttributeValuesController;
use Src\Products\Infrastructure\Http\Controllers\ListProductsController;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,    
])
->prefix('api')
->group(function () {
    Route::get('/teste-api', function () {
        return 'This is your multi-tenant application. The id of the current tenant iss ' . tenant('id');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::post('/', CreateProductController::class)->name('products.create');
        Route::get('/', ListProductsController::class)->name('products.list');
        Route::post('/attributes', CreateAttributeController::class)->name('products.attributes.create');
        Route::get('/attributes', ListAttributesController::class)->name('products.attributes.list');
        Route::post('/attributes/values', CreateAttributeValueController::class)->name('products.attributes.values.create');
        Route::get('/attributes/values', ListAttributeValuesController::class)->name('products.attributes.values.list');
    });
});
