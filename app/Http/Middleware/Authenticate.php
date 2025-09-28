<?php
namespace App\Http\Middleware;

// Middleware проверяет авторизацию.

// Поддерживает как веб-запросы, так и API-запросы.

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Получение пути, на который перенаправлять неавторизованных пользователей.
     *
     * Если запрос ожидает JSON → возвращаем null (для API)
     * Иначе → перенаправляем на маршрут login
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
