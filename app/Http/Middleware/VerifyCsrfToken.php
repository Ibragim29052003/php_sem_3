<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Список URI, которые исключены из проверки CSRF токена.
     * Можно добавлять пути API или вебхуки внешних сервисов.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
