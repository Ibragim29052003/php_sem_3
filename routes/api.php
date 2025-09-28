<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Здесь регистрируются все маршруты API вашего приложения.
| Эти маршруты автоматически загружаются через RouteServiceProvider
| и получают middleware-группу "api".
|
*/

// Пример маршрута API, доступного только авторизованным пользователям через Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Возвращает данные текущего аутентифицированного пользователя
    return $request->user();
});
