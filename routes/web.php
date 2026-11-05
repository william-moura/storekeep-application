<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tenant;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/criar-empresa/{slug}', function ($slug) {    
    try {
        $tenant = Tenant::create(['id' => $slug, 'company_name' => "Empresa " . ucfirst($slug)]);
        $tenant->domains()->create(['domain' => "{$slug}.localhost"]);

        return "Tenant {$slug} criado com sucesso!";
    } catch (\Exception $e) {
        return "Erro ao criar tenant {$slug}: " . $e->getMessage();
    }
});

Route::get('/teste-api', function () {
    return 'This is your multi-tenant application. The id of the current tenant is william' ;
});