<?php

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/teste-api', function () {
    return 'This is your multi-tenant application. The id of the current tenant is william' ;
});
Route::get('/criar-empresa/{slug}', function ($slug) {
    $tenant = Tenant::create(['id' => $slug, 'company_name' => "Empresa " . ucfirst($slug)]);
    $tenant->domains()->create(['domain' => "{$slug}.api.localhost"]);

    return "Tenant {$slug} criado com sucesso!";
});