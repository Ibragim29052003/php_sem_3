<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов приложения (dependency injection, биндинги)
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap сервисов приложения
     * (например, добавление глобальных макросов или кастомной логики)
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
