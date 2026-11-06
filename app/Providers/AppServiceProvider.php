<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Products\Domain\Repositories\ProductRepositoryInterface;
use Src\Products\Infrastructure\Persistence\Repositories\ProductRepository;
use Src\Products\Infrastructure\Persistence\Repositories\AttributeRepository;
use Src\Products\Domain\Repositories\AttributeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
