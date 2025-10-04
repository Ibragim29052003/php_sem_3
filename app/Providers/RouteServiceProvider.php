<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Путь до "домашней" страницы приложения.
     * Обычно сюда перенаправляется пользователь после успешной аутентификации.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Настройка привязки моделей к маршрутам (route model binding),
     * фильтров для параметров маршрута и прочей конфигурации роутов.
     */
    public function boot(): void
    {
        // Настройка rate limiter для API запросов
        // Ограничение: максимум 60 запросов в минуту для одного пользователя или IP
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip() // идентификатор пользователя или IP
            );
        });

        // Группировка маршрутов и подключение соответствующих файлов
        $this->routes(function () {
            // API маршруты → префикс /api
            // ДЛЯ 9 ЛАБЫ И МЕНЬШЕ
            // Route::middleware('api:sanctum')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            // ДЛЯ 10 ЛАБЫ 
                Route::middleware('api') // просто api
                    ->prefix('api')
                    ->group(base_path('routes/api.php'));


            // Веб маршруты → без префикса, обычные веб-роуты
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
